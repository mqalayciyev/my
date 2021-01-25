<?php
if(!isset($_GET['page']) && $_GET['page'] !== "search"){
    header("Location: index.php?page=search&search=&button=search");
}


?>

<div class="col-12 px-0">
    <div id="search" class="">
        <form class="col-12 px-0" action="index.php?page=search" method="get">
            <div class="input-group border border-secondary">
                <input type="hidden" name="page" value="search">
                <input type="search" class="form-control col-12 border-0" name="search" value="<?=$_GET['search']?>" placeholder="Axtarış . . .">
                <div class="input-group-append" style="z-index: 0;">
                    <button type="submit" class="btn btn-outline-dark bg-white border-0 rounded-0" name="button" value="search">
                        <i class="fas fa-search i-text"></i></button>
                </div>
            </div>
        </form>

        <h3 class="my-4">2 Nəticə "<?=$_GET['search']?>"</h3>

        <div class="w-100 results">

            <div class="col-12  my-3">
                <div class="row bg-white h-100">
                    <div class="col-12 col-xl-3 px-0">
                        <img src="img/news/img0.jpg" class="w-100" alt="">
                    </div>
                    <div class="col-12 col-xl-9 align-self-center">
                        <h4>"Onsuz da, “Zaqatala” hər mövsüm əziyyət çəkir"</h4>
                        <p>“Bütün komandalar kimi, biz də sentyabrın əvvəlindən bir araya gəlmişik“. Sportinfo.az xəbər verir ki, bu sözlər “Zaqatala“nın baş məşqçisi Rüstəm Məmmədova məxsusdur. I Divizion təmsilçisinin çalışdırıcı bildirib ki, toplanışın ilk iki həftəsində daha çox seleksiyaya diqqət ayırıblar: “Tətbiq olunan limit bizə çox çətinlik yaradır. “Zaqatala”nın U-19 komandası olmadığından U-17-dən bəzi oyunçuları sıralarımıza dəvət etdik. Baxışa gələnləri də sınaqdan keçirdik. Artıq heyəti koplektləşdirmişik. Bu günə kimi yalnız bir yoxlama görüşü keçirmişik. “Qəbələ” ilə qarşılaşmışıq. Əslində, həmin oyunu heç sınaq matçı da adlandırmaq düz olmaz. Çünki biz U-19 komandası ilə oynamaq istəyirdik. Ancaq həmin vaxt “Qəbələ”nin həmin yaş qrupunun əksər üzvləri yığmanın toplanışına yollandığından bizə qarşı 16-17 yaşlı uşaqlar oynadı. Təbii ki, bu da istənilən effekti vermədi. Zaqatala bir qədər uzaq bölgə olduğundan yoxlama görüşü üçün rəqib tapmaqda çətinlik çəkirik. Əvvəlki illərdə bu boşluğu Gürcüstan komandalarının sayəsində aradan qaldıra bilirdik. Hər il qonşu ölkənin güclülər dəstəsində çıxış edən kollektivlərlə üz-üzə gəlirdik. Ancaq bu il pandemiya səbəbindən sərhədlər bağlı olduğundan ora yollana bilmədik. Əvəzində tez-tez ikitərəfli oyunlar keçirirdik. Bəli, hazırlıq dönəmində bir yoxlama görüşü keçirmək çox azdır. Ancaq başqa çarəmiz yoxdu. Onsuz da, “Zaqatala” hər il mövsümün əvvəlində 3-4 tur əziyyət çəkir. Sonradan formaya düşərək oyunumuzu tapırıq. Yəqin bu il də eyni aqibəti yaşayacağıq. Məqsədimiz mükafatçılar sırasında yer almaqdır”.</p>
                        <span>28 Dekabr 2020 | Xəbərlər</span>

                    </div>
                </div>
            </div>

            <div class="col-12 my-3">
                <div class="row bg-white h-100">
                    <div class="col-12 col-xl-3 px-0">
                        <img src="img/staff/men/male.jpg" class="w-100" alt="">
                    </div>
                    <div class="col-12 col-xl-9 align-self-center">
                        <h4>Vüsal Şabanov</h4>
                        <p>Mövqe / Qapıçı</p>
                        <span>Heyət</span>

                    </div>
                </div>
            </div>
            
        </div>
    </div>

</div>