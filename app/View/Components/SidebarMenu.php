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
                "children" => [
                    [
                        "name" => "Data pribadi",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Inpassing",
                        "link" => "Menu 2"
                    ],
                    [
                        "name" => "Kualifikasi",
                        "link" => "Menu 2"
                    ],
                    [
                        "name" => "Penempatan",
                        "link" => "Menu 2"
                    ]
                ],
                "role" => ["admin_dsdm"]
            ],
            [
                "id" => 2,
                "name" => "Kualifikasi",
                "type" => "dropdown",
                "children" => [
                    [
                        "name" => "Pendidikan formal",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Diklat",
                        "link" => "Menu 2"
                    ],
                    [
                        "name" => "Riwayat Pekerjaan",
                        "link" => "Menu 2"
                    ]
                ],
                "role" => ["admin_dsdm"]
            ],
            [
                "id" => 3,
                "name" => "Kompetensi",
                "type" => "dropdown",
                "children" => [
                    [
                        "name" => "Sertifikasi",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Tes",
                        "link" => "Menu 2"
                    ]
                ],
                "role" => ["admin_dsdm"]
            ],
            [
                "id" => 4,
                "name" => "Pelaks. pendidikan",
                "type" => "dropdown",
                "children" => [
                    [
                        "name" => "Pengajaran",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Bimbingan mahasiswa",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Pengujian mahasiswa",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Visiting scientist",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Pembinaan mahasiswa",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Bahan ajar",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Datasering",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Orasi ilmiah",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Pembimbing dosen",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Tugas tambahan",
                        "link" => "Menu 1"
                    ],
                ],
                "role" => ["admin_dsdm"]
            ],
            [
                "id" => 5,
                "name" => "Pelaks. penelitian",
                "type" => "dropdown",
                "children" => [
                    [
                        "name" => "Penelitian",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Publikasi karya",
                        "link" => "Menu 2"
                    ],
                    [
                        "name" => "Paten/HKI",
                        "link" => "Menu 2"
                    ],
                ],
                "role" => ["admin_dsdm"]
            ],
            [
                "id" => 6,
                "name" => "Pelaks. pengabdian",
                "type" => "dropdown",
                "children" => [
                    [
                        "name" => "Pengabdian",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Pengelola jurnal",
                        "link" => "Menu 2"
                    ],
                    [
                        "name" => "Pembicara",
                        "link" => "Menu 2"
                    ],
                    [
                        "name" => "Jabatan struktural",
                        "link" => "Menu 2"
                    ],
                ],
                "role" => ["admin_dsdm"]
            ],
            [
                "id" => 7,
                "name" => "Penunjang",
                "type" => "dropdown",
                "children" => [
                    [
                        "name" => "Anggota profesi",
                        "link" => "Menu 1"
                    ],
                    [
                        "name" => "Penghargaan",
                        "link" => "Menu 2"
                    ],
                    [
                        "name" => "Penunjang lain",
                        "link" => "Menu 2"
                    ]
                ],
                "role" => ["admin_dsdm"]
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
