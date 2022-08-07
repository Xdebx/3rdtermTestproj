<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Customer;
use App\Models\User;
use App\Models\Pet;


class CustomersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
    /*    return datatables()
            ->eloquent($query)
            ->addColumn('action', 'customers.action')*/

        // $customers = Customer::with('pets');
        $customers = Customer::withTrashed()->with('pets','users')->orderBy('customer_id','DESC');
       //$customers =  Customer::with(['user','pets.pet_name'])->select('customers.*');

        return datatables()
            ->eloquent($customers)
            ->addColumn('action', function($row) {
                return "<a href=". route('customer.restore', $row->customer_id). " class=\"btn btn-warning\">Restore</a> 

                <form action=". route('customer.destroy', $row->customer_id). " method= \"POST\" >". csrf_field() .
                '<input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
                  </form>';
            
            })
            ->addColumn('users', function (Customer $customers) {
                return $customers->users->email;
            })
            
            ->addColumn('pets', function (Customer $customers) {
                    return $customers->pets->map(function($pet) {
                    return "<li>".$pet->pname. "</li>";
                    })->implode('<br>'); 
                })
            ->addColumn('img_path', function ($customers) {
                    $url= asset('images/'.$customers->img_path);
                    return '<img src="'.$url.'" border="0" width="90" height="90" align="center">';
                })

            ->rawColumns(['img_path','pets','user','action']);      

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model)
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
                    ->setTableId('customers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(3)
                    ->buttons(
                       
                        Button::make('export'),
                        // Button::make('print'),
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
       /* return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];*/

         return [
            
            Column::make('customer_id'),
            // Column::make('title')->title('Title'),
            // Column::make('fname')->title('Fname'),
            Column::make('lname')->title('Customers'),
            Column::make('users')->name('users.email')->title('Email'),
            Column::make('phone')->title('Phone'),
            Column::make('img_path')->title('Image'),
            Column::make('pets')->name('pets.pname')->title('Pets'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('deleted_at'),
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
        return 'Customers_' . date('YmdHis');
    }
}