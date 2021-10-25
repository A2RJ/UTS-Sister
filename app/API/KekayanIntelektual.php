<?php

namespace App\API;

/**
 * Kekayan Intelektual
 */
trait KekayanIntelektual
{
    static $KekayanIntelektual = [
        "view" => ["create", "read", "update"],
        "id_kategori_kegiatan" => "select",
        "id_jenis_publikasi" => "select",
        "id_kategori_capaian_luaran" => "select",
        "id_litabmas" => "text",
        "judul" => "text",
        "tanggal" => "date",
        "nomor_paten" => "text",
        "pemberi_paten" => "text",
        "penerbit" => "text",
        "isbn" => "text",
        "jumlah_halaman" => "text",
        "tautan" => "text",
        "keterangan" => "text",
        "dokumen" => "file",
        "urutan_corresponding_author" => "text",
        "penulis_dosen" => [
            "id_sdm" => "text",
            "no_urut" => "text",
            "afiliasi" => "text",
            "peran" => "text",
        ],
        "penulis_mahasiswa" => [
            "id_peserta_didik" => "text",
            "nama" => "text",
            "no_induk" => "text",
            "no_urut" => "text",
            "afiliasi" => "text",
            "peran" => "text",
        ],
        "penulis_lain" => [
            "id_orang" => "text",
            "no_urut" => "text",
            "afiliasi" => "text",
            "peran" => "text",
        ]
    ];

    public static function getKekayanIntelektual($id_sdm)
    {
        return self::get("/kekayaan_intelektual?id_sdm=$id_sdm");
    }

    public static function postKekayanIntelektual($request)
    {
        return self::post("/kekayaan_intelektual", [
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_jenis_publikasi" => $request->id_jenis_publikasi,
            "id_kategori_capaian_luaran" => $request->id_kategori_capaian_luaran,
            "id_litabmas" => $request->id_litabmas,
            "judul" => $request->judul,
            "tanggal" => $request->tanggal,
            "nomor_paten" => $request->nomor_paten,
            "pemberi_paten" => $request->pemberi_paten,
            "penerbit" => $request->penerbit,
            "isbn" => $request->isbn,
            "jumlah_halaman" => $request->jumlah_halaman,
            "tautan" => $request->tautan,
            "keterangan" => $request->keterangan,
            "dokumen" => [$request->dokumen],
            "urutan_corresponding_author" => $request->urutan_corresponding_author,
            "penulis_dosen" => [
                [
                    "id_sdm" => $request->id_sdm,
                    "no_urut" => $request->no_urut,
                    "afiliasi" => $request->afiliasi,
                    "peran" => $request->peran,
                ]
            ],
            "penulis_mahasiswa" => [
                [
                    "id_peserta_didik" => $request->id_peserta_didik,
                    "nama" => $request->nama,
                    "no_induk" => $request->no_induk,
                    "no_urut" => $request->no_urut,
                    "afiliasi" => $request->afiliasi,
                    "peran" => $request->peran,
                ]
            ],
            "penulis_lain" => [
                [
                    "id_orang" => $request->id_orang,
                    "no_urut" => $request->no_urut,
                    "afiliasi" => $request->afiliasi,
                    "peran" => $request->peran,
                ]
            ]
        ]);
    }
    public static function getKekayanIntelektualID($id_kekayaan_intelektual)
    {
        return self::get("/kekayaan_intelektual/$id_kekayaan_intelektual");
    }

    public static function putKekayanIntelektual($request)
    {
        return self::put("/kekayaan_intelektual/$request->id_kekayaan_intelektual", [
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_jenis_publikasi" => $request->id_jenis_publikasi,
            "id_kategori_capaian_luaran" => $request->id_kategori_capaian_luaran,
            "id_litabmas" => $request->id_litabmas,
            "judul" => $request->judul,
            "tanggal" => $request->tanggal,
            "nomor_paten" => $request->nomor_paten,
            "pemberi_paten" => $request->pemberi_paten,
            "penerbit" => $request->penerbit,
            "isbn" => $request->isbn,
            "jumlah_halaman" => $request->jumlah_halaman,
            "tautan" => $request->tautan,
            "keterangan" => $request->keterangan,
            "dokumen" => [$request->dokumen],
            "urutan_corresponding_author" => $request->urutan_corresponding_author,
            "penulis_dosen" => [
                [
                    "id_sdm" => $request->id_sdm,
                    "no_urut" => $request->no_urut,
                    "afiliasi" => $request->afiliasi,
                    "peran" => $request->peran,
                ]
            ],
            "penulis_mahasiswa" => [
                [
                    "id_peserta_didik" => $request->id_peserta_didik,
                    "nama" => $request->nama,
                    "no_induk" => $request->no_induk,
                    "no_urut" => $request->no_urut,
                    "afiliasi" => $request->afiliasi,
                    "peran" => $request->peran,
                ]
            ],
            "penulis_lain" => [
                [
                    "id_orang" => $request->id_orang,
                    "no_urut" => $request->no_urut,
                    "afiliasi" => $request->afiliasi,
                    "peran" => $request->peran,
                ]
            ]
        ]);
    }

    public static function deleteKekayanIntelektual($id_kekayaan_intelektual)
    {
        return self::delete("/kekayaan_intelektual/$id_kekayaan_intelektual");
    }

    public static function getKekayanIntelektualBidang($id_kekayaan_intelektual)
    {
        return self::get("/kekayaan_intelektual/$id_kekayaan_intelektual/bidang_ilmu");
    }

    public static function putKekayanIntelektualBidang($request)
    {
        return self::put("/kekayaan_intelektual/$request->id_kekayaan_intelektual/bidang_ilmu", [
            $request->id_kelompok_bidang
        ]);
    }
}
