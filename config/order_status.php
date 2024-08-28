<?php

return [
    'order_status_admin' => [
        '0' => [
            'status' => 'pending',
            'details' => 'Pembayaran diterima dan akan segera diproses'
        ],
        '1' => [
            'status' => 'Sedang diproses',
            'details' => 'Pesanan sedang diproses'
        ],
        '2' => [
            'status' =>'Dropped Off',
            'details' => 'Pesanan telah diantar ke point pick up dan akan dikirim'
        ],
        3 => [
            'status' => 'Terkirim',
            'details' => 'Pesanan telah sampai ke alamat tujuan'
        ],
    ],

    'order_status_vendor' => [
        '0' => [
            'status' => 'pending',
            'details' => 'Pembayaran diterima dan akan segera diproses'
        ],
        '1' => [
            'status' => 'Sedang diproses',
            'details' => 'Pesanan sedang diproses'
        ],
        '2' => [
            'status' =>'Dropped Off',
            'details' => 'Pesanan telah diantar ke point pick up dan akan dikirim'
        ],
        3 => [
            'status' => 'Terkirim',
            'details' => 'Pesanan telah sampai ke alamat tujuan'
        ],
    ]
];
