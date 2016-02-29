<hmtl>
    <head>
        <title>Jump</title>
        <meta name="Description" content="<?php echo $this->input->get("content"); ?>">
        <style type="text/css">
            body
            {
                background-color: #4CFF00;

            }
            h1
            {
                text-align: center;
                font-size: xx-large;
                color:blue;
            }
            h2{
                text-align: center;
            }
            img.logo
            {
                position: absolute;
                left: 10px;
                top: 10px;
                width: 100px;
            }
            img.board
            {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 30%;
            }
            div.header
            {
                margin-left: auto;
                margin-right: auto;
                width: 50%;
                display: block;
                position: relative;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <h1>Jump</h1>
            <img src="asset/img/flip-grass.png" class="logo"/>
            <img src="asset/img/flip-grass.png" class="logo" style="left:auto; right: 10px;"/>
        </div>

        <a href="https://play.google.com/store/apps/details?id=smartpointer.jump" title="Jump is on Google Play">
            <img src="getImage/<?php echo $this->input->get('image'); ?>" class="board"/>
        </a>
        <h2><?php echo $this->input->get("content"); ?></h2>
        <h2><a href="https://play.google.com/store/apps/details?id=smartpointer.jump">Vieni a vedere Jump su Google Play!</a></h2>
    </body>
</hmtl>



