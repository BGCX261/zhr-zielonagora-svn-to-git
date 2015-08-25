<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>

<link   href="phplib/jquery.pwi/js/jquery.slimbox2/jquery.slimbox2.css" rel="stylesheet" type="text/css"/>
<script src="phplib/jquery.pwi/js/jquery.slimbox2/jquery.slimbox2.js" type="text/javascript"></script>
<script src="phplib/jquery.pwi/js/jquery.blockUI.js" type="text/javascript"></script>

<link   href="phplib/jquery.pwi/css/pwi.css" rel="stylesheet" type="text/css"/>
<script src="phplib/jquery.pwi/js/jquery.pwi.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $("#container").pwi({
            username: 'wlp.zgora',
            showAlbumDescription: true,
            //showPhotoCaption: true,
            //photoCaptionLength: 5,
            thumbSize: 144,
            showPhotoCaptionDate: true,
            showSlideshowLink: true,//-- Display link to slideshow (native Picasa Web Album slideshow) on photo page
            labels: {photo:"zdjêcie",
                     photos: "zdjêæ",
                     albums: "Wróæ do albumów",
                     slideshow: "Pokaz slajdów",
                     loading: "Pobieram dane...",
                     page: "Strona",
                     prev: "Poprzednie",
                     next: "Nastêpne",
                     devider: "|"
                },
            months: ["Stycznia",
                    "Lutego",
                    "Marca",
                    "Kwietnia",
                    "Maja",
                    "Czerwca",
                    "Lipca",
                    "Sierpnia",
                    "Wrze¶nia",
                    "Pa¼dziernika",
                    "Listopada",
                    "Grudnia"],
            slimbox_config: {       //-- override default slimbox configuration and behaviour (see for details: http://code.google.com/p/slimbox/wiki/jQueryManual)
                        loop: false,
                        overlayOpacity: 0.6,
                        overlayFadeDuration: 400,
                        resizeDuration: 400,
                        resizeEasing: "swing",
                        initialWidth: 250,
                        initlaHeight: 250,
                        imageFadeDuration: 400,
                        captionAnimationDuration: 400,
                        counterText: "{x}/{y}",
                        closeKeys: [27, 88, 67, 70],
                        prevKeys: [37, 80],
                        nextKeys: [39, 83]
            },
            blockUIConfig: {        //-- override default blockUI configuration and behaviour (see for details: http://malsup.com/jquery/block/#options )
                message: null,
                css: "pwi_loader"
            }

        });
    });
</script>
