<?php

namespace App\API;

/**
 * Publikasi
 */
trait Publikasi
{
    public static function getPublikasi($id_sdm)
    {
        return self::get("/publikasi?id_sdm=$id_sdm");
    }

    public static function postPublikasi($request)
    {
        return self::post("/publikasi", [
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
            ],
            "judul_artikel" => $request->judul_artikel,
            "judul_asli" => $request->judul_asli,
            "nama_jurnal" => $request->nama_jurnal,
            "halaman" => $request->halaman,
            "edisi" => $request->edisi,
            "volume" => $request->volume,
            "nomor" => $request->nomor,
            "doi" => $request->doi,
            "issn" => $request->issn,
            "e_issn" => $request->e_issn,
            "seminar" => $request->seminar,
            "prosiding" => $request->prosiding
        ]);
    }
    public static function getPublikasiID($id_Publikasi)
    {
        return self::get("/publikasi/$id_Publikasi");
    }

    public static function putPublikasi($request)
    {
        return self::put("/publikasi/$request->id_Publikasi", [
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
            ],
            "judul_artikel" => $request->judul_artikel,
            "judul_asli" => $request->judul_asli,
            "nama_jurnal" => $request->nama_jurnal,
            "halaman" => $request->halaman,
            "edisi" => $request->edisi,
            "volume" => $request->volume,
            "nomor" => $request->nomor,
            "doi" => $request->doi,
            "issn" => $request->issn,
            "e_issn" => $request->e_issn,
            "seminar" => $request->seminar,
            "prosiding" => $request->prosiding
        ]);
    }

    public static function deletePublikasi($id_Publikasi)
    {
        return self::delete("/publikasi/$id_Publikasi");
    }

    public static function getPublikasiBidang($id_Publikasi)
    {
        return self::get("/publikasi/$id_Publikasi/bidang_ilmu");
    }

    public static function putPublikasiBidang($request)
    {
        return self::put("/publikasi/$request->id_Publikasi/bidang_ilmu", [
            $request->id_kelompok_bidang
        ]);
    }
}
