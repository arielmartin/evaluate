 $(document).ready(function(){
        jQuery('#camera_wrap').camera({
            loader: 'pie',
            pagination: true ,
            minHeight: '200',
            thumbnails: true,
            height: '40.85106382978723%',
            caption: true,
            navigation: true,
            fx: 'mosaic'
          });
        $().UItoTop({ easingType: 'easeOutQuart' });
               $('.tooltip').tooltipster();
        });