<?php

namespace App\DataTables;

use App\Models\Employee;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmployeesDataTable extends DataTable
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

            $employees = Employee::with('users')->orderBy('emp_id','DESC');
            //$customers =  Customer::with(['user','pets.pet_name'])->select('customers.*');
     
             return datatables()
                 ->eloquent($employees)
                 ->addColumn('action', function($row) {
                         return "<a href=". route('employee.edit', $row->emp_id). " class=\"btn btn-warning\">Edit</a> 
                       
                        <form action=". route('employee.destroy', $row->user_id). " method= \"POST\" >". csrf_field() . '<input name="_method" type="hidden" value="DELETE">
                         <button class="btn btn-danger" type="submit">Delete</button>
                           </form>';

                 })

                 ->addColumn('users', function (Employee $employees) {
                    return $employees->users->email;
                })

                 ->addColumn('img_path', function ($employees) {
                         $url= asset('images/'.$employees->img_path);
                         return '<img src="'.$url.'" border="0" width="90" height="90" align="center">';
                     })
     

                 ->rawColumns(['img_path','users','action']);
                 // ->rawColumns(['pets','action']);
                /*  ->addColumn('user', function (Customer $customers) {
                        // return "<p>" .$albums->artist->artist_name."</p>";
                     return $customers->user->email;
                     })
                 */
                
                //->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
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
                    ->setTableId('employees-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
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
            
            Column::make('emp_id'),
            Column::make('position')->title('Positions'),
            Column::make('lname')->title('Employees'),
            Column::make('addressline')->title('Addressline'),
            Column::make('zipcode')->title('Zipcode'),
            Column::make('phone')->title('Phone'),
            Column::make('img_path')->title('Image'),
            Column::make('users')->name('users.email')->title('Email'),
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
        return 'Employees_' . date('YmdHis');
    }
}
