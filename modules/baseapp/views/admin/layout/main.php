<?php defined('SYSPATH') or die('No direct access allowed.'); ?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8"/>
        <title><?php echo $title; ?></title>
        <?php echo Static_Css::getInstance()->getAll() ?>
        <?php echo Static_Hack::getInstance()->getAll() ?>
        <?php echo Static_Js::getInstance()->getAll() ?>

        <script type="text/javascript">
            $(document).ready(function() 
            { 
                $(".tablesorter").tablesorter(); 
            } 
        );
            $(document).ready(function() {

                //When page loads...
                $(".tab_content").hide(); //Hide all content
                $("ul.tabs li:first").addClass("active").show(); //Activate first tab
                $(".tab_content:first").show(); //Show first tab content

                //On Click Event
                $("ul.tabs li").click(function() {

                    $("ul.tabs li").removeClass("active"); //Remove any "active" class
                    $(this).addClass("active"); //Add "active" class to selected tab
                    $(".tab_content").hide(); //Hide all tab content

                    var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                    $(activeTab).fadeIn(); //Fade in the active ID content
                    return false;
                });

            });
        </script>
        <script type="text/javascript">
            $(function(){
                $('.column').equalHeight();
            });
        </script>

    </head>


    <body>

        <header id="header">
            <hgroup>
                <h1 class="site_title"><a href="<?php echo Route::url('admin');?>">Website Admin</a></h1>
                <h2 class="section_title">Dashboard</h2>
                <div class="btn_view_site">
                    <a href="<?php echo Route::url('default')?>">View Site</a>
                </div>
            </hgroup>
        </header> <!-- end of header bar -->

        <section id="secondary_bar">
            <div class="user">
                <p><?php echo $_user->username; ?> (<a href="#">3 Messages</a>)</p>
                <!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
            </div>
            <div class="breadcrumbs_container">
                <article class="breadcrumbs"><a href="<?php echo Route::url('admin');?>">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
            </div>
        </section><!-- end of secondary bar -->

        <aside id="sidebar" class="column">
            <form class="quick_search">
                <input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
            </form>
            <hr/>            
            <?php echo Helpers_Menu::render('menu'); ?>

            <footer>
                <hr />
                <p><strong>Copyright &copy; 2011 Snoter.ru</strong></p>
                <p>Copyright text</p>
            </footer>
        </aside><!-- end of sidebar -->

        <section id="main" class="column">
            <?php echo $content ?>
        </section>

    </body>

</html>