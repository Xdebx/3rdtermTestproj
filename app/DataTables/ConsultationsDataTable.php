<?php

namespace App\DataTables;

use App\Models\Consultation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Pet;
use App\Models\Disease;
use App\Models\Employee;


class ConsultationsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {


        $consults = Consultation::with(['pet','disease','employee'])->select('health_consultation.*');
        // $customers = Customer::withTrashed()->with('pets','users')->orderBy('customer_id','DESC');

        return datatables()
        ->eloquent($consults)
        ->addColumn('action', function($row) {
            return "<a href=". route('consult.edit', $row->consult_id). " class=\"btn btn-warning\">Edit</a>
            <form action=". route('consult.destroy', $row->consult_id). " method= \"POST\" >". csrf_field() .
             '<input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
              </form>';
        })
        ->addColumn('employee', function (Consultation $consults) {
            return $consults->employee->lname;
        })
        ->addColumn('pet', function (Consultation $consults) {
            return $consults->pet->pname;
        })
        
        ->addColumn('disease', function (Consultation $consults) {
                return $consults->disease->map(function($disease) {
                return "<li>".$disease->disease_name. "</li>";
                })->implode('<br>'); 
            })

        ->rawColumns(['pet','employee','disease','action']);      

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Consultation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Consultation $model)
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
                    ->setTableId('health_consultation-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
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
            
            Column::make('consult_id'),
            Column::make('pet')->name('pet.pname')->title('Pets'),
            Column::make('disease')->name('disease.disease_name')->title('Diseases'),
            Column::make('employee')->name('employee.lname')->title('Veterinarian'),
            Column::make('observation')->title('Comment'),
            Column::make('consult_cost')->title('Cost'),
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
        return 'Consultations_' . date('YmdHis');
    }
}