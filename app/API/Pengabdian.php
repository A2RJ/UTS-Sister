<?php

namespace App\API;

/**
 * Pengabdian
 */
trait Pengabdian
{
    public static function getPengabdian($id_sdm)
    {
        return self::get("/pengabdian?id_sdm=$id_sdm");
    }

    public static function postPengabdian($request)
    {
        return self::post("/pengabdian", [
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "judul" => $request->judul,
            "id_afiliasi" => $request->id_afiliasi,
            "id_kelompok_bidang" => $request->id_kelompok_bidang,
            "id_litabmas_sebelumnya" => $request->id_litabmas_sebelumnya,
            "id_jenis_skim" => $request->id_jenis_skim,
            "lokasi" => $request->lokasi,
            "tahun_usulan" => $request->tahun_usulan,
            "tahun_kegiatan" => $request->tahun_kegiatan,
            "tahun_pelaksanaan" => $request->tahun_pelaksanaan,
            "lama_kegiatan" => $request->lama_kegiatan,
            "tahun_pelaksanaan_ke" => $request->tahun_pelaksanaan_ke,
            "dana_dikti" => $request->dana_dikti,
            "dana_perguruan_tinggi" => $request->dana_perguruan_tinggi,
            "dana_institusi_lain" => $request->dana_institusi_lain,
            "in_kind" => $request->in_kind,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_sk_penugasan" => $request->tanggal_sk_penugasan,
            "mitra_litabmas" => [$request->mitra_litabmas],
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
            ],
            "dokumen" => [$request->dokumen]
        ]);
    }
    public static function getPengabdianID($id_pengabdian)
    {
        return self::get("/pengabdian/$id_pengabdian");
    }

    public static function putPengabdian($request)
    {
        return self::put("/pengabdian/$request->id_pengabdian", [
            "id_kategori_kegiatan" => $request->id_kategori_kegiatan,
            "judul" => $request->judul,
            "id_afiliasi" => $request->id_afiliasi,
            "id_kelompok_bidang" => $request->id_kelompok_bidang,
            "id_litabmas_sebelumnya" => $request->id_litabmas_sebelumnya,
            "id_jenis_skim" => $request->id_jenis_skim,
            "lokasi" => $request->lokasi,
            "tahun_usulan" => $request->tahun_usulan,
            "tahun_kegiatan" => $request->tahun_kegiatan,
            "tahun_pelaksanaan" => $request->tahun_pelaksanaan,
            "lama_kegiatan" => $request->lama_kegiatan,
            "tahun_pelaksanaan_ke" => $request->tahun_pelaksanaan_ke,
            "dana_dikti" => $request->dana_dikti,
            "dana_perguruan_tinggi" => $request->dana_perguruan_tinggi,
            "dana_institusi_lain" => $request->dana_institusi_lain,
            "in_kind" => $request->in_kind,
            "sk_penugasan" => $request->sk_penugasan,
            "tanggal_sk_penugasan" => $request->tanggal_sk_penugasan,
            "mitra_litabmas" => [$request->mitra_litabmas],
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
            ],
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function deletePengabdian($id_pengabdian)
    {
        return self::delete("/pengabdian/$id_pengabdian");
    }

    public static function getPengabdianBidang($id_pengabdian)
    {
        return self::get("/pengabdian/$id_pengabdian/bidang_ilmu");
    }

    public static function putPengabdianBidang($request)
    {
        return self::put("/pengabdian/$request->id_pengabdian/bidang_ilmu", [
            $request->id_kelompok_bidang
        ]);
    }
}
