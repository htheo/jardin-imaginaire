<style>
    * { box-sizing: border-box; }

    body { font-family: sans-serif; }

    /* ---- grid ---- */

    .grid {
        background: #EEE;
        max-width: 100%;
    }

    /* clearfix */
    .grid:after {
        content: '';
        display: block;
        clear: both;
    }

    /* ---- grid-item ---- */
    /* 3 columns by default */
    .grid-sizer { width: 33.333%; }

    @media screen and (min-width: 768px) {
        /* 5 columns for larger screens */
        .grid-sizer { width: 20%; }
    }
    .grid-item {
        width: 20%;
        height: auto;
        float: left;
        background: #D26;
    }
    .grid-item--width2 { width: 40%; }
    .grid-item--width3 { width: 60%; }
    .grid-item--width4 { width: 80%; }

    .grid-item--height2 { height: 100%; }
    .grid-item--height3 { height: auto; }
    .grid-item--height4 { height: auto; }

</style>
<h1>Masonry - columnWidth</h1>

<div class="grid">
    <div class="grid-sizer"></div>
    <div class="grid-item"></div>
    <img class="grid-item grid-item--width2" src="http://www.artvertcreations.com/images/resized/images/diaporama/jardinier-paysagiste-creation-jardin-06-cannes-antibes-nice-5_1400_800.jpg" alt="">
    <img class="grid-item" src="http://static3.seety.pagesjaunes.fr/dam_2286346/3a12a034-c7b9-434b-b828-5cca8ee04397-1200">
    <img class="grid-item grid-item--width3" src="http://www.designferia.com/sites/default/files/images/14-jardin-minimaliste-paysagiste-interieur.jpg">
    <div class="grid-item grid-item--height2"></div>..
</div>
<script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>

<script src="https://unpkg.com/masonry-layout@4.1/dist/masonry.pkgd.min.js"></script>
<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
<script>
$('.grid').masonry({
itemSelector: '.grid-item',
columnWidth: '.grid-sizer',
percentPosition: true
});

// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
    $grid.masonry('layout');
});
</script>
