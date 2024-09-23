<?php

namespace App\DataTables;

use App\Models\order;
// use App\Models\sellerOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class userOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($query){
            $showBtn = "<a href='".route('user.orders.show', $query->id)."' class='btn btn-primary mb-1'>Tampilkan</a>";
            return $showBtn;
        })
        ->addColumn('customer', function($query){
            return $query->user->name;
        })
        ->addColumn('date', function($query){
            return date('d-M-Y', strtotime($query->created_at));
        })
        ->addColumn('payment_status', function($query){
            if($query->payment_status == 1){
                return '<span class="badge bg-success">Berhasil</span>';
            }
            else{
                return '<span class="badge bg-danger">Pending</span>';
            }
        })
        ->addColumn('order_status', function($query){
            switch($query->order_status){
                case 0:
                    return '<span class="badge bg-info">Pending</span>';
                    break;
                case 1:
                    return '<span class="badge bg-secondary">Sedang Diproses</span>';
                    break;
                case 2:
                    return '<span class="badge bg-primary">Dropped off</span>';
                    break;
                case 3:
                    return '<span class="badge bg-warning">Terkirim</span>';
                    break;
                case 4:
                    return '<span class="badge bg-success">Selesai</span>';
                    break;
                case 5:
                    return '<span class="badge bg-danger">Batal</span>';
                    break;
            };

        })
        ->rawColumns(['action', 'payment_status', 'order_status'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(order $model): QueryBuilder
    {
        return $model::where('user_id', Auth::user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('userorder-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('invoice_id'),
            Column::make('customer'),
            Column::make('product_qty'),
            Column::make('date'),
            Column::make('ammount'),
            Column::make('order_status'),
            Column::make('payment_status'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'userOrder_' . date('YmdHis');
    }
}
