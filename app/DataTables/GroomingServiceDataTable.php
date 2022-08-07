<?php

namespace App\DataTables;

use App\Models\GroomingService;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GroomingServiceDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        //$groomingservices = GroomingService::all();

        // $groomingservice = GroomingService::with('pets')->orderBy('service_id','DESC');;

        return datatables()
        ->eloquent($query)
        ->addColumn('action', function($row){
            return "<a href=". route('grooming.edit', $row->service_id). " class=\"btn btn-warning\">Edit</a>
                    <form action=". route('grooming.destroy', $row->service_id). " method= \"POST\" >". csrf_field() .
                     '<input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                      </form>';
        })

        ->addColumn('img_path', function($groomingservices){
            $url= asset('images/'.$groomingservices->img_path);
           return '<img src="'.$url.'" border="0" width="90" height="90" align="center">';

           })

           ->rawColumns(['img_path','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\GroomingService $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(GroomingService $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('grooming_service-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                       // Button::make('create'),
                        //Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('service_id'),
            Column::make('service_name')->title('Service Name'),
            Column::make('service_cost')->title('Service Cost'),
            Column::make('img_path')->title('Image'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'GroomingService_' . date('YmdHis');
    }
}
