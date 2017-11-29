<?php

use Illuminate\Database\Seeder;
use App\Page;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page1 = new Page();
        $page1->title = "Tentang Pakan";
        $page1->content = 'Di peternakan sapi perah rakyat terdapat beberapa pola penyediaan hijauan yang ada di peternakan sapi perah saat ini. Pada peternakan rakyat, hijauan diadakan sendiri baik dari kebun sendiri maupun dengan mencari dari lahan-lahan umum yang ada disekitarnya. Kebun hijauan peternak ada yang dimiliki sendiri rataan luasan 0,8 ha. Disamping itu ada juga peternak hanya mengelola lahan milik perkebunan, perhutani dengan sistem tanam campuran dengan rataan luasan 1,43 ha. Kebun hijauan yang dimiliki peternak rakyat secara privat, tidak mampu memenuhi kebutuhan ternak sepanjang tahun. Sebagian pemenuhan hijauan pada peternakan rakyat mengandalkan hijauan yang ditanam di lahan-lahan yang bekerjasama dengan perkebunan atau kehutanan. Meskipun sudah mengelola lahan milik perkebunan dan kehutanan, peternak rakyat masih kesulitan untuk menyediakan hijauan selama musim kemarau (bulan Juli – Oktober, bervariasi tergantung lokasi). Secara rata-rata, hanya 62,5% kebutuhan hijauan per tahun yang dapat dipenuhi oleh peternak sendiri. Pada musim kemarau dimana hijauan sulit diperoleh, peternak terpaksa mengganti hijauan dengan jerami (55,76%), menambah pemberian konsentrat (32,7%) bahkan sebagian peternak terpaksa mengurangi jumlah pemberian hijauan (9,6%) atau menjual ternak (1,9%). Penggunaan legum pohon seperti gamal dan kaliandra juga meningkat pada musim kemarau.';
        $page1->slug = "tentang-pakan";
        $page1->image = "sapi.png";
        $page1->save();
        
        $page2 = new Page();
        $page2->title = "Kebutuhsan Sapi";
        $page2->content = '';
        $page2->slug = "kebutuhan-sapi";
        $page2->image = "kebutuhan-sapi.png";
        $page2->save();
        
        $page3 = new Page();
        $page3->title = "Literatur";
        $page3->content = '<h3>Bahan Pelatihan:</h3>
        <ul>
        <li><a href="http://dairyfeed.ipb.ac.id/wp-content/uploads/2017/09/Formulasi-Ransum-Ruminansia.pptx" target="_blank">Teknik Formulasi Ransum untuk Ruminansia</a></li>
        <li><a href="http://dairyfeed.ipb.ac.id/wp-content/uploads/2017/09/Formulasi-Ransum-WInfeed-Software.pptx" target="_blank">Software WInfeed</a></li>
        <li><a href="http://dairyfeed.ipb.ac.id/wp-content/uploads/2017/09/Formulasi-Ransum-FORSUM-ver-2.0.pptx" target="_blank">Panduan FORSUM for Ruminant</a></li>
        <li><a href="http://dairyfeed.ipb.ac.id/wp-content/uploads/2017/09/FORSUM-for-PAKAN-LOKAL.xlsm" target="_blank">File Solver FORSUM ver 2,0</a></li>
        <li><a href="http://dairyfeed.ipb.ac.id/wp-content/uploads/2017/09/SNI-Konsentra-Sapi-Perah.pdf" target="_blank">Standar SNI Pakan Sapi Perah</a></li>
        <li><a href="http://dairyfeed.ipb.ac.id/wp-content/uploads/2017/09/SNI-Konsentrat-Sapi-Potong.pdf">Standar SNI Pakan Sapi&nbsp;Potong</a></li>
        </ul>
        ';
        $page3->slug = "literatur";
        $page3->image = "sapi.png";
        $page3->save();
        
        $page4 = new Page();
        $page4->title = "Publikasi";
        $page4->content = '
        <table width="620">
        <tbody>
        <tr>
        <td width="38">No</td>
        <td width="228">Judul Karya Tulis</td>
        <td width="118">Nama Penulis</td>
        <td width="118">Nama Jurnal</td>
        <td width="118">No Penerbitan</td>
        </tr>
        <tr>
        <td width="38">1</td>
        <td width="228">Utilization of Mungbean’s Green House Fodder and Silage in the Ration for Lactating Dairy Cows</td>
        <td width="118">Zahera, R, I.G. Permana, . Despal</td>
        <td><a href="http://journal.ipb.ac.id/index.php/mediapeternakan/article/viewFile/9190/7793">Media Peternakan</a></td>
        <td width="118">Vol 38/2. (2015)</td>
        </tr>
        <tr>
        <td width="38">2</td>
        <td width="228">Utilization of Bioslurry on Maize Hydroponic Fodder as a Corn Silage Supplement on Nutrient Digestibility and Milk Production of Dairy Cows</td>
        <td width="118">Nugroho H.D., I.G. Permana, . Despal</td>
        <td width="118"><a href="http://journal.ipb.ac.id/index.php/mediapeternakan/article/viewFile/8821/7279">Media Peternakan</a></td>
        <td width="118">Vol 38/1. (2015)</td>
        </tr>
        <tr>
        <td width="38">3</td>
        <td width="228">Wafer as Feed Supplement Stimulates the Productivity of Bali Calves</td>
        <td width="118">Y. Retnani, C. Arman, S. Said, I.G. Permana, A. Saenab</td>
        <td width="118"><a href="http://docsdrive.com/pdfs/knowledgia/ajas/0000/61454-61454.pdf">APCBEE Procedia</a></td>
        <td width="118">Vol 8, pp 173–177 (2014)</td>
        </tr>
        <tr>
        <td width="38">4</td>
        <td width="228">Biscuit bio-supplement for increasing milk production and quality in dairy goat farm</td>
        <td width="118">Retnani Y, I.G. Permana, N.R. Komalasari, R.Roslina, A. Ikhwanti</td>
        <td width="118"><a href="http://docsdrive.com/pdfs/knowledgia/ajas/0000/61454-61454.pdf">Asian Journal of Animal Sciences&nbsp;</a></td>
        <td width="118">Vol. 8 (1), 15-23 (2014)</td>
        </tr>
        <tr>
        <td width="38">5</td>
        <td width="228">Physical characteristic and palatability of biscuit bio-supplement for dairy goat</td>
        <td width="118">Y. Retnani, I.G. Permana and L.C. Purba</td>
        <td width="118"><a href="http://docsdrive.com/pdfs/ansinet/pjbs/0000/55471-55471.pdf">Pakistan Journal of Biological Science</a></td>
        <td width="118">2014</td>
        </tr>
        <tr>
        <td width="38">6</td>
        <td width="228">Study on the Correlation between Body Measurement and Feed Intake on the Growth Performance of Heifer and Calf at Different Topographical Locations</td>
        <td width="118">S Syawal, BP Purwanto, IG Permana</td>
        <td width="118"><a href="http://repository.unhas.ac.id/bitstream/handle/123456789/8320/777-1251-1-SM.pdf?sequence=1">Jurnal Ilmu dan Teknologi Peternakan</a></td>
        <td width="118">Vol 2 (3), 175-188 (2014)</td>
        </tr>
        <tr>
        <td width="38">7</td>
        <td width="228">Roles of Dietary Cobalt and Administration of Mixed Rumen Bacteria in Regulating Hematological Parameters of Pre-weaning Twin Lambs</td>
        <td width="118">T Adelina, A Boediono, I G Permana, T R Wiradarya, D Evvyernie, T Toharmat</td>
        <td><a href="http://journal.ipb.ac.id/index.php/mediapeternakan/article/viewFile/7186/5590">Media Peternakan</a></td>
        <td width="118">Vol 36/2. (2013):</td>
        </tr>
        <tr>
        <td width="38">8</td>
        <td width="228">Model Penentuan Suhu Kritis Pada Sapi Perah Berdasarkan Kemampuan Produksi Dan Manajemen Pakan</td>
        <td width="118">D Suherman, BP Purwanto, W Manalu, IG Permana</td>
        <td width="118">Jurnal Sain Peternakan Indonesia</td>
        <td width="118">Vol 8 (2), pp 120 (2013)</td>
        </tr>
        <tr>
        <td width="38">9</td>
        <td width="228">Keasaman cairan tubuh dan rasio kelamin anak domba garut (Ovis aries) yang diberi kation-anion ransum yang berbeda.</td>
        <td width="118">Fathul,F., T. Toharmat, I.G. Permana dan A. Budiono.</td>
        <td width="118"><a href="http://journal.ipb.ac.id/index.php/mediapeternakan/article/viewFile/1086/294">Media Peternakan.</a></td>
        <td width="118">Vol.13/2:pp 87-98 (2012)</td>
        </tr>
        <tr>
        <td width="38">10</td>
        <td width="228">Pengaruh Complete Rumen Modifier (CRM) dan Calliandra calothyrus terhadap produktivitas dan gas metan enterik pada kambing perah PE</td>
        <td width="118">N.M.S. Sukmawati, I.G. Permana, A. Thalib and S. Kompiang</td>
        <td width="118"><a href="http://medpub.litbang.pertanian.go.id/index.php/jitv/article/view/611/620">Jurnal Ilmu Ternak dan Veteriner.</a></td>
        <td width="118">Vol.16/3. pp 173-183 (2011)</td>
        </tr>
        <tr>
        <td width="38">11</td>
        <td width="228">Addition of Water Soluble Carbohydrate Sources Prior to Ensilage for Ramie Leaves Silage Qualities Improvement.</td>
        <td width="118">Despal, I G Permana, S N Safarina and A J Tatra</td>
        <td width="118"><a href="http://journal.ipb.ac.id/index.php/mediapeternakan/article/viewFile/3171/2115">Media Peternakan</a></td>
        <td width="118">Vol 34/1 pp 69-76 (2011):</td>
        </tr>
        <tr>
        <td width="38">12</td>
        <td width="228">Performance of Garut Breed Rams Fed Diets Containing Various CationAnion<br>
        Difference with or Without Fish Oil Supplementation</td>
        <td width="118">Hidayat, R. T.Toharmat, A.Boediono, dan I.G. Permana.</td>
        <td width="118"><a href="http://medpub.litbang.pertanian.go.id/index.php/jitv/article/view/615/624">Jurnal Ilmu Ternak dan Veteriner.</a></td>
        <td width="118">Vol 16/3: pp 211-217 (2011)</td>
        </tr>
        <tr>
        <td width="38">13</td>
        <td width="228">Mineral Utilization in Rams Fed Ration Supplemented with Different Levels of Chromium, Calcium, and Cation-Anion Balances.</td>
        <td width="118">D Sudrajat, T Toharmat, A Boediono, I G Permana, R I Arifiantini, and F Amir</td>
        <td width="118"><a href="http://journal.ipb.ac.id/index.php/mediapeternakan/article/viewFile/3957/2697">Media Peternakan</a></td>
        <td width="118">Vol 34/3, pp 212-218 (2011)</td>
        </tr>
        <tr>
        <td width="38">14</td>
        <td width="228">Production, nutritional composition and in vitro digestibility of indigofera sp at different interval and intensity of defoliations</td>
        <td width="118">Andi Tarigan, L. Abdullah, S.P. Ginting, I.G. Permana</td>
        <td width="118"><a href="Produksi%20dan%20Komposisi%20Nutrisi%20Serta%20Kecernaan%20In%20Vitro%20Indigofera%20sp%20pada">Jurnal Ilmu Ternak dan Veteriner</a></td>
        <td>Vol 15, No 3. (2010)</td>
        </tr>
        <tr>
        <td width="38">15</td>
        <td width="228">Manipulasi kondisi fisiologis dan keasaman semen melalui pengaturan perbedaan kation-anion ransum dan supplemen asam lemak pada domba.</td>
        <td width="118">Hidayat, R. T.Toharmat, A.Boediono, dan I.G. Permana.</td>
        <td width="118"><a href="http://medpub.litbang.pertanian.go.id/index.php/jitv/article/view/360/369">Jurnal Ilmu Ternak dan Veteriner.</a></td>
        <td width="118">Vol 14./1: pp 25-35 (2009)</td>
        </tr>
        <tr>
        <td width="38">16</td>
        <td width="228">Supplementation of Bangun-bangun leaf (Coleus amboinicus Lour) and Zn-vitamin E to improve metabolism and milk production of Etawah cross bred goats</td>
        <td width="118">S.D. Rumetor, J. Jachja, R. Widjajakusuma, I.G. Permana, I-K. Sutama</td>
        <td><a href="http://medpub.litbang.pertanian.go.id/index.php/jitv/article/view/579/588">Jurnal Ilmu Ternak dan Veteriner</a></td>
        <td width="118">Vol 13,/3. pp 174-181 (2008)</td>
        </tr>
        <tr>
        <td width="38">17</td>
        <td width="228">Nutritional properties of three different origins of Indonesian Jatropha (Jatropha curcas) meal for ruminant.</td>
        <td width="118">Permana, I.G., Despal and Gandini, L.</td>
        <td width="118"><a href="http://repository.ipb.ac.id/handle/123456789/36248">Journal of Agriculture and Rural Development in the Tropics and Substropics.&nbsp;</a></td>
        <td width="118">Beiheft 90, pp 94-101 (2007)</td>
        </tr>
        <tr>
        <td width="38">18</td>
        <td width="228">Pengaruh Suhu Air Minum Terhadap Konsumsi Air, Kecernaan Bahan Kering dan Bahan Organik Pada Sapi Holstein.</td>
        <td width="118">B.P Purwanto, Y. Kurniawati dan I.G. Permana.</td>
        <td width="118">Jurnal Pengembangan Tropis Special Edition Seminar Nasional Ruminansia.</td>
        <td width="118">Vol.02:104-109&nbsp; (2004)</td>
        </tr>
        <tr>
        <td width="38">19</td>
        <td width="228">The solubilization of macrominerals and ruminal degradation of selected tropical tree legumes.</td>
        <td width="118">Permana, I.G. and Despal.</td>
        <td width="118"><a href="https://books.google.co.id/books?id=Cg8fWLPBidkC&amp;pg=PA37&amp;lpg=PA37&amp;dq=The+solubilization+of+macrominerals+and+ruminal+degradation+of+selected+tropical+tree+legumes.&amp;source=bl&amp;ots=FrOJoNUgP5&amp;sig=oIZVY1iXQXBsRJj_5mA8NUwXsYE&amp;hl=en&amp;sa=X&amp;ved=0ahUKEwiX8vaf4q3LAh">Journal of Agriculture and Rural Development in the Tropics and Substropics.&nbsp;</a></td>
        <td width="118">Beiheft 88, 44 – 52. (2003)</td>
        </tr>
        <tr>
        <td width="38">20</td>
        <td width="228">Cultivation of Pleurotus ostreatus and Lentinus edodes on lignocellulosic substrates for human food and animal feed production.</td>
        <td width="118">Permana, I.G., U. ter Meulen and F. Zadrazil.</td>
        <td width="118"><a href="http://www.uni-kassel.de/upress/online/frei/978-3-89958-076-1.volltext.frei.pdf">Journal of Agriculture and Rural Development in theTropics and Subtropics.&nbsp;</a></td>
        <td width="118">80:137-143.&nbsp; ISSN: 1613-8422 (2003)</td>
        </tr>
        <tr>
        <td width="38">21</td>
        <td width="228">Use of sugarcane bagasse for mushroom and animal feed production.</td>
        <td width="118">Permana, I.G.,&nbsp; G. Flachowsky, U. ter Meulen and F. Zadrazil.</td>
        <td width="118"><a href="http://www.isms.biz/maastricht/volume-15-part-1-article-47/">Mushroom Science.&nbsp;</a></td>
        <td width="118">XXI:385-390 (2000)</td>
        </tr>
        <tr>
        <td width="38">22</td>
        <td width="228">Study on The Biodegradaton of Lignocellulose Wastes by Wood DegradingFungi for Animal Feed.</td>
        <td width="118">Permana, I.G.</td>
        <td width="118"><a href="https://cuvillier.de/de/shop/publications/3590-study-on-the-biodegradation-of-lignocellulose-wastes-by-wood-degrading-fungi-for-animal-feed">Book. Cuvillier Verlag</a></td>
        <td width="118">ISBN-10: 3898735176: ISBN-13:978388735179 (2002)</td>
        </tr>
        <tr>
        <td width="38">23</td>
        <td width="228">Effect of feeding fungal treated palm press fibre on dry matter consumption and nutrient utilization in sheep.</td>
        <td width="118">Permana, I.G., U. Meulen and T. Sutardi.</td>
        <td width="118">Buletin Ilmu Makanan Ternak Vol. 12:1 17-21.</td>
        <td width="118">Buletin Ilmu Makanan Ternak Vol. 12:1 17-21.</td>
        </tr>
        </tbody>
        </table>
        ';
        $page4->slug = "publikasi";
        $page4->image = "";
        $page4->save();
        
        $page5 = new Page();
        $page5->title = "Expert";
        $page5->content = '
        <p><a href="http://dairyfeed.ipb.ac.id/wp-content/uploads/2017/09/Idat-G-Permana.png"><img class="alignleft size-full wp-image-157" src="http://dairyfeed.ipb.ac.id/wp-content/uploads/2017/09/Idat-G-Permana.png" alt="Idat G Permana" width="225" height="225"></a><span style="color: #0000ff;"><strong>Dr.Ir. Idat Galih Permana, MSc.</strong></span> adalah dosen tetap pada Bagian Ilmu Nutrisi Ternak Perah, Departemen Ilmu Nutrisi dan Teknologi Pakan, Fakultas Peternakan, Institut Pertanian Bogor (IPB). Idat Galih Permana lulus sebagai sarjana peternakan IPB pada tahun 1990, kemudian pada tahun 1993 melanjutkan studi Program S2 di Goettingen University Jerman dalam bidang Ilmu Nutrisi Ternak. Pada tahun 1998 kembali melanjutkan pendidikan Progran S3 di universitas yang sama dan lulus sebagai Doktor dalam bidang Ilmu Nutrisi Ternak.</p>
        <p>Pada tahun 2007-2013 Idat Galih Permana pernah menjabat sebagai Ketua Departemen Ilmu Nutrisi dan Teknologi Pakan, Fakultas Peternakan IPB. Saat ini Idat Galih Permana adalah Direktur Integrasi Data dan Sistem Informasi IPB.</p>
        <hr>
        <p><a href="http://dairyfeed.ipb.ac.id/wp-content/uploads/2017/09/Despal.png"><img class="alignleft size-full wp-image-238" src="http://dairyfeed.ipb.ac.id/wp-content/uploads/2017/09/Despal.png" alt="Despal" width="230" height="290"></a></p>
        <p>Dr. Despal, SPt, MSc. adalah dosen Departemen Ilmu Nutrisi dan Teknologi Pakan, Fakultas Peternakan, Institut Pertanian Bogor. Pada tahun 1993 Dr. Despal&nbsp;lulus sebagai sarjana peternakan dari Fakultas Peternakan IPB, dan pada &nbsp;tahun 1998 mendapat gelar master dari Goettingen University Jerman dan tahun 20014&nbsp;memperoleh doktor dari universitas yang sama. Saat ini Dr Despal aktif dalam mengelola Program Studi Logistik Peternakan.</p>
        ';
        $page5->slug = "Expert";
        $page5->image = "";
        $page5->save();
    }
}
