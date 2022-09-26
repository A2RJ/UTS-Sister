<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarMenu extends Component
{
    public $menu;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        /**
         * Get semua data menu dari database
         * Get semua data role dari hakl akses yang diberikan pada database
         * Sehingga berelasi antara menu, hak akses user dan hak akses spatie
         */
        $this->menu = [
            [
                "id" => 1,
                "name" => "Profil",
                "type" => "dropdown",
                "role" => ["admin_dsdm"],
                "children" => [
                    [
                        "name" => "Data pribadi",
                        "link" => route('datapribadi')
                    ],
                    [
                        "name" => "Inpassing",
                        "link" => route('inpassing')
                    ],
                    [
                        "name" => "Jabatan Fungsional",
                        "link" => route('jabatan-fungsional')
                    ],
                    [
                        "name" => "Kepangkatan",
                        "link" => route('kepangkatan')
                    ],
                    [
                        "name" => "Penempatan",
                        "link" => route('penempatan')
                    ]
                ],
            ],
            [
                "id" => 2,
                "name" => "Kualifikasi",
                "type" => "dropdown",
                "role" => ["admin_dsdm"],
                "children" => [
                    [
                        "name" => "Pendidikan formal",
                        "link" => route('pendidikan-formal')
                    ],
                    [
                        "name" => "Diklat",
                        "link" => route('diklat')
                    ],
                    [
                        "name" => "Riwayat Pekerjaan",
                        "link" => route('riwayat-pekerjaan')
                    ]
                ],
            ],
            [
                "id" => 3,
                "name" => "Kompetensi",
                "type" => "dropdown",
                "children" => [
                    [
                        "name" => "Sertifikasi Profesi",
                        "link" => route('sertifikasi-profesi')
                    ],
                    [
                        "name" => "Tes",
                        "link" => route('test')
                    ]
                ],
                "role" => ["admin_dsdm"]
            ],
            [
                "id" => 4,
                "name" => "Pelaks. pendidikan",
                "type" => "dropdown",
                "role" => ["admin_dsdm"],
                "children" => [
                    [
                        "name" => "Pengajaran",
                        "link" => route('pengajaran')
                    ],
                    [
                        "name" => "Bimbingan mahasiswa",
                        "link" => route('bimbingan-mahasiswa')
                    ],
                    [
                        "name" => "Pengujian mahasiswa",
                        "link" => route('pengujian-mahasiswa')
                    ],
                    [
                        "name" => "Visiting scientist",
                        "link" => route('visiting-scientist')
                    ],
                    // [
                    //     "name" => "Pembinaan mahasiswa",
                    //     "link" => route('')
                    // ],
                    [
                        "name" => "Bahan ajar",
                        "link" => route('bahan-ajar')
                    ],
                    [
                        "name" => "Detasering",
                        "link" => route('detasering')
                    ],
                    [
                        "name" => "Orasi ilmiah",
                        "link" => route('orasi-ilmiah')
                    ],
                    [
                        "name" => "Pembimbing dosen",
                        "link" => route('pembimbing-dosen')
                    ],
                    [
                        "name" => "Tugas tambahan",
                        "link" => route('tugas-tambahan')
                    ],
                ],
            ],
            [
                "id" => 5,
                "name" => "Pelaks. penelitian",
                "type" => "dropdown",
                "role" => ["admin_dsdm"],
                "children" => [
                    [
                        "name" => "Penelitian",
                        "link" => route('penelitian')
                    ],
                    [
                        "name" => "Publikasi karya",
                        "link" => route('publikasi-karya')
                    ],
                    [
                        "name" => "Paten/HKI",
                        "link" => route('paten-hki')
                    ],
                ],
            ],
            [
                "id" => 6,
                "name" => "Pelaks. pengabdian",
                "type" => "dropdown",
                "role" => ["admin_dsdm"],
                "children" => [
                    [
                        "name" => "Pengabdian",
                        "link" => route('pengabdian')
                    ],
                    [
                        "name" => "Pengelola jurnal",
                        "link" => route('penglola-jurnal')
                    ],
                    [
                        "name" => "Pembicara",
                        "link" => route('pembicara')
                    ],
                    [
                        "name" => "Jabatan struktural",
                        "link" => route('jabatan-struktural')
                    ],
                ],
            ],
            [
                "id" => 7,
                "name" => "Penunjang",
                "type" => "dropdown",
                "role" => ["admin_dsdm"],
                "children" => [
                    [
                        "name" => "Anggota profesi",
                        "link" => route('anggota-profesi')
                    ],
                    [
                        "name" => "Penghargaan",
                        "link" => route('penghargaan')
                    ],
                    [
                        "name" => "Penunjang lain",
                        "link" => route('penunjang-lain')
                    ]
                ],
            ],
            // [
            //     "id" => 2,
            //     "name" => "Dashboard",
            //     "type" => "single",
            //     "link" => "/",
            //     "role" => ["admin_dsdm"]
            // ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar-menu');
    }
}
