<?php

namespace App\API;

/**
 * Bahan Ajar
 */
trait BahanAjar
{
    static $BahanAjar = [
        "view" => ["create", "read", "update"],
        "id_kategori_kegiatan" => "select",
        "id_kategori_capaian_luaran" => "select",
        "id_penelitian_pengabdian" => "select",
        "id_jenis_bahan_ajar" => "select",
        "judul" => "text",
        "isbn" => "text",
        "nama_penerbit" => "text",
        "tanggal_terbit" => "date",
        "sk_penugasan" => "text",
        "tanggal_sk_penugasan" => "date",
        "dokumen" => "file",
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
        "penulis_lain" =>            [
            "id_orang" => "text",
            "no_urut" => "text",
            "afiliasi" => "text",
            "peran" => "text",
        ]
    ];

    public static function getBahanAjar($id_sdm)
    {
        return self::get("/bahan_ajar?id_sdm=$id_sdm");
    }

    public static function postBahanAjar($request)
    {
        return self::post("/bahan_ajar", [
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_kategori_capaian_luaran" => $request->id_kategori_capaian_luaran,
            "id_penelitian_pengabdian" => $request->id_penelitian_pengabdian,
            "id_jenis_bahan_ajar" => $request->id_jenis_bahan_ajar,
            "judul" => $request->judul,
            "isbn" => $request->isbn,
            "nama_penerbit" => $request->nama_penerbit,
            "tanggal_terbit" => $request->tanggal_terbit,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_sk_penugasan" => $request->tanggal_sk_penugasan,
            "dokumen" => [$request->dokumen],
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
            "penulis_lain" =>            [
                [
                    "id_orang" => $request->id_orang,
                    "no_urut" => $request->no_urut,
                    "afiliasi" => $request->afiliasi,
                    "peran" => $request->peran,
                ]
            ]
        ]);
    }

    public static function getBahanAjarID($id_bahan_ajar)
    {
        return self::get("/bahan_ajar/$id_bahan_ajar");
    }

    public static function putBahanAjar($request)
    {
        return self::put("/bahan_ajar/$request->id_bahan_ajar", [
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "id_kategori_capaian_luaran" => $request->id_kategori_capaian_luaran,
            "id_penelitian_pengabdian" => $request->id_penelitian_pengabdian,
            "id_jenis_bahan_ajar" => $request->id_jenis_bahan_ajar,
            "judul" => $request->judul,
            "isbn" => $request->isbn,
            "nama_penerbit" => $request->nama_penerbit,
            "tanggal_terbit" => $request->tanggal_terbit,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_sk_penugasan" => $request->tanggal_sk_penugasan,
            "dokumen" => [$request->dokumen],
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
            "penulis_lain" =>            [
                [
                    "id_orang" => $request->id_orang,
                    "no_urut" => $request->no_urut,
                    "afiliasi" => $request->afiliasi,
                    "peran" => $request->peran,
                ]
            ]
        ]);
    }

    public static function deleteBahanAjar($id_bahan_ajar)
    {
        return self::delete("/bahan_ajar/$id_bahan_ajar");
    }
}
