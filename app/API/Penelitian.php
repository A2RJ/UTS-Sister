<?php

namespace App\API;

/**
 * Penelitian
 */
trait Penelitian
{
    public static function getPenelitian($id_sdm)
    {
        $return = self::get("/penelitian?id_sdm=$id_sdm");
    }

    public static function postPenelitian($request)
    {
        return self::post("/penelitian", [
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
            "anggota_dosen" => [
                [
                    "id_sdm" => $request->id_sdm,
                    "aktif" => $request->aktif,
                    "peran" => $request->peran,
                ]
            ],
            "anggota_mahasiswa" => [
                [
                    "id_peserta_didik" => $request->id_peserta_didik,
                    "nama" => $request->nama,
                    "no_induk" => $request->no_induk,
                    "aktif" => $request->aktif,
                    "peran" => $request->peran,
                ]
            ],
            "anggota_lain" => [
                [
                    "id_orang" => $request->id_sdm,
                    "aktif" => $request->aktif,
                    "peran" => $request->peran,
                ]
            ],
            "dokumen" => [$request->dokumen]
        ]);
    }
    public static function getPenelitianID($id_penelitian)
    {
        return self::get("/penelitian/$id_penelitian");
    }

    public static function putPenelitian($request)
    {
        return self::put("/penelitian/$request->id_penelitian", [
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
            "anggota_dosen" => [
                [
                    "id_sdm" => $request->id_sdm,
                    "aktif" => $request->aktif,
                    "peran" => $request->peran,
                ]
            ],
            "anggota_mahasiswa" => [
                [
                    "id_peserta_didik" => $request->id_peserta_didik,
                    "nama" => $request->nama,
                    "no_induk" => $request->no_induk,
                    "aktif" => $request->aktif,
                    "peran" => $request->peran,
                ]
            ],
            "anggota_lain" => [
                [
                    "id_orang" => $request->id_sdm,
                    "aktif" => $request->aktif,
                    "peran" => $request->peran,
                ]
            ],
            "dokumen" => [$request->dokumen]
        ]);
    }

    public static function deletePenelitian($id_penelitian)
    {
        return self::delete("/penelitian/$id_penelitian");
    }

    public static function getPenelitianBidang($id_penelitian)
    {
        return self::get("/penelitian/$id_penelitian/bidang_ilmu");
    }

    public static function putPenelitianBidang($request)
    {
        return self::put("/penelitian/$request->id_penelitian/bidang_ilmu", [
            $request->id_kelompok_bidang
        ]);
    }
}
