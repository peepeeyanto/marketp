<?php

namespace App\DataTables;

use App\Models\product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class productDataTable extends DataTable
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
                $editBtn = "<a href='".route('admin.products.edit', $query->id)."' class='btn btn-primary mr-2'>edit</a>";
                $deleteBtn = "<a href='".route('admin.products.destroy', $query->id)."' class='btn btn-danger delete-item'>delete</a>";
                $moreBtn = '<div class="btn-group dropleft">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            More
                            </button>
                            <div class="dropdown-menu dropleft">
                                <a class="dropdown-item" href="'.route('admin.products-image-gallery.index', ['product' => $query->id]).'">Galeri gambar</a>
                                <a class="dropdown-item" href="'.route('admin.products-variant.index', ['product' => $query->id]).'">Varian produk</a>s
                            </div>';
                return $editBtn.$deleteBtn.$moreBtn;
            })
            ->addColumn('image', function($query){
                return "<img width='100px' src='".asset($query->thumb_image)."'></img>";
            })
            ->rawColumns(['image', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
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
            Column::make('image'),
            Column::make('qty'),
            Column::make('price'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(200)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'product_' . date('YmdHis');
    }
}
