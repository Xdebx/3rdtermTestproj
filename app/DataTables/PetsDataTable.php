<?php

namespace App\DataTables;

use App\Models\Pet;
use App\Models\Customer;
use App\Models\Breed;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PetsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $pets = Pet::with(['customers'])->select('pets.*');
        // $pets =  Pet::with(['customers:lname','breeds:pbreed'])->select('pets.*');

        //$customers =  Customer::with(['user','pets.pet_name'])->select('customers.*');
 
         return datatables()
             ->eloquent($pets)
             ->addColumn('action', function($row) {
                return "<a href=". route('pet.edit', $row->pet_id). " class=\"btn btn-warning\">Edit</a>
                <form action=". route('pet.destroy', $row->pet_id). " method= \"POST\" >". csrf_field() .
                 '<input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
                  </form>';
             
             })
             ->addColumn('customers', function(Pet $pets){
                return $pets->customers->lname;
            })
             
             ->addColumn('img_path', function ($pets) {
                     $url= asset('images/'.$pets->img_path);
                     return '<img src="'.$url.'" border="0" width="90" height="90" align="center">';
                 })
 
             ->rawColumns(['img_path','customers','breeds','action']);      
 
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pet $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pet $model)
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
                    ->setTableId('pets-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
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

            Column::make('pet_id'),
            Column::make('customers')->name('customers.lname')->title('Owner'),
            Column::make('pname')->title('Pet name'),
            Column::make('breed')->title('Breed'),
            Column::make('gender')->title('Gender'),
            Column::make('age')->title('Age'),
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
        return 'Pets_' . date('YmdHis');
    }
}
