<?php

namespace App\DataTables;
use App\Models\productVariantItem;
use App\Models\sellerProductsVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class sellerProductsVariantItemDataTable extends DataTable
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
                $editBtn = "<a href='".route('seller.products-variant-item.edit', $query->id)."' class='btn btn-primary mb-2'>edit</a>";
                $deleteBtn = "<a href='".route('seller.products-variant-item.destroy', $query->id)."' class='btn btn-danger delete-item'>delete</a>";
                return $editBtn.'<br>'.$deleteBtn;
            })
            ->addColumn('variant_name', function($query){
                return $query->productVariant->name;
            })
            ->addColumn('status', function($query){
                if($query->status){
                    $button = '<div class="form-check form-switch">
                                    <input checked class="form-check-input change-status" data-id="'.$query->id.'" type="checkbox" id="flexSwitchCheckDefault">
                                </div>';
                }else{
                    $button = '<div class="form-check form-switch">
                                    <input class="form-check-input change-status" data-id="'.$query->id.'" type="checkbox" id="flexSwitchCheckDefault">
                                </div>';
                }
                return $button;
            })
            ->addColumn('is_default', function($query){
                if($query->is_default == 1){
                    return '<i class="badge bg-success">Default</i>';
                }else{
                    return '<i class="badge bg-danger">Not Default</i>';
                }
            })
            ->rawColumns(['action', 'status', 'is_default'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(productVariantItem $model): QueryBuilder
    {
        return $model->where('product_variant_id', request()->variantID)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('sellerproductsvariantitem-table')
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
            Column::make('name'),
            Column::make('variant_name'),
            Column::make('price'),
            Column::make('is_default'),
            Column::make('status'),
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
        return 'sellerProductsVariantItem_' . date('YmdHis');
    }
}
