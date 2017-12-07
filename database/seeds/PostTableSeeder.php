<?php

use Illuminate\Database\Seeder;
use App\Post;
use Carbon\Carbon;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post();
        $post->title = "Persusuan di Indonesia";
        $post->subtitle = "Persusuan di Indonesia";
        $post->page_image = "sapi2.jpg";
        $post->content_raw = "Kebijakan pemerintah yang mencanangkan swasembada susu 50% pada tahun 2020 sepertinya masih jauh panggang dari api. Hal tersebut dibuktikan dari kontribusi domestik yang terus menurun. Kontribusi susu nasional pada awal tahun 2005 mampu mencapai angka 30%, namun angka tersebut terus menurun hingga mencapai 18% pada tahun 2012. Kondisi usaha persusuan nasional diperburuk oleh jumlah populasi ternak yang semakin berkurang dari tahun ke tahun. Hal ini terlihat pada penurunan populasi sapi perah yang tajam (mencapai 30%) pada koperasi-koperasi besar yang disebabkan oleh program swasembada daging hingga akhir tahun 2014. Banyak sapi-sapi perah berkerangka besar namun berproduksi susu rendah yang dipotong untuk memenuhi permintaan masyarakat akan produk daging. Pada sisi lain peningkatan kesadaran masyarakat untuk mengkonsumsi susu yang didorong oleh keberhasilan program pemerintah mampu meningkatkan rataan konsumsi susu penduduk Indonesia, yaitu dari 7 kg/kapita/tahun menjadi 11 kg/kapita/tahun. Pemerintah terus berusaha untuk mencapai konsumsi 15 kg/kapita/tahun untuk meyamai negara-negara tetangga. Sehingga dapat dibayangkan kontribusi domestik akan terus menurun sebagai akibat adanya penurunan populasi dan peningkatan permintaan.";
        $post->meta_description = "Persusuan di Indonesia";
        $post->is_draft = false;
        $post->published_at = new Carbon();
        $post->save();

        $post2 = new Post();
        $post2->title = "Kepemilikan Sapi Perah di Indonesia";
        $post2->subtitle = "Kepemilikan Sapi Perah di Indonesia";
        $post2->page_image = "populasi.png";
        $post2->content_raw = "Berdasarkan hasil survey, secara nasional tingkat kepemilikan ternak baru mencapai 7 ekor atau 6 ST. Sedangkan kepemilikan sapi laktasi rata-rata 4,27 ekor. Tingkat kepemilikan tersebut sudah dapat memberikan income untuk memenuhi kebutuhan pokok peternak, namun belum dapat memberikan kesejahteraan bagi peternak karena belum terpenuhinya kebutuhan sekunder apalagi kebutuhan tertier.
                                Dengan tingkat kepemilikan demikian, peternak dapat bertahan tanpa kehilangan asetnya, namun sulit untuk berkembang dan memupuk modal. Diperlukan peningkatan skala usaha sapi perah mendekati 8 ST atau > 5 ekor sapi laktasi dimana peternak dapat memenuhi kebutuhan pokok dan sekundernya serta dapat menumpuk modal bagi perkembangan usahanya. Skala ekonomi 10 ST dengan 7 ekor sapi laktasi tentu sangat ideal. Namun pencapaian peningkatan secara bertahap perlu dilakukan dengan penyesuaian-penyesuaian kemampuan peternak dalam mengelola usahanya.";
        $post2->meta_description = "Kepemilikan sapi perah di indonesia";
        $post2->is_draft = false;
        $post2->published_at = new Carbon();
        $post2->save();
    }
}