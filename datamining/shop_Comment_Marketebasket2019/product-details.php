<?php
include("db.php");

$prodID = $_GET['prodid'];

if (!empty($prodID)) {
    $sqlSelectSpecProd = mysql_query("select * from products where id = '$prodID'") or die(mysql_error());
    $getProdInfo = mysql_fetch_array($sqlSelectSpecProd);
    $prodname = $getProdInfo["Product"];
    $prodcat = $getProdInfo["Category"];
    $prodprice = $getProdInfo["Price"];
    $proddesc = $getProdInfo["Description"];
    $prodimage = $getProdInfo["imgUrl"];
}
?>
<?php include('include/home/header.php'); ?>
bdeebj

<style>
    .feed-card {
        margin-bottom: 20px;
        padding-left: 0;
    }
    .anx .qf.b {
        margin-top: 15px;
    }
    .b {
        position: relative;
        display: block;
        border-radius: 4px;
        padding: 10px 15px;
        margin-bottom: -1px;
        background-color: #fff;
        border: 1px solid #d3e0e9;
    }.qf, .qg {
        zoom: 1;
        overflow: hidden;
    }
    .qf {
        margin-top: 15px;
    }
    .qf, .qg {
        overflow: auto;
    }
    .aml {
        padding: 20px !important;
    }
    ul li {
        list-style: none;
    }
    ul, ol {
        font-size: 14px;
        line-height: 24px;
    }   

    element.style {
        float: left;
    }
    .qg {
        width: 85%;
    }
    .qj, .qi, .qg {
        display: inline-block;
        vertical-align: top;
    }
    .qf, .qg {
        zoom: 1;
        overflow: hidden;
    }
    .qf, .qg {
        overflow: auto;
    }
    html * {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    html, body, div, span, object, iframe, p, blockquote, h1, h2, h3, h4, h5, h6, pre, abbr, address, cite, code, del, dfn, em, img, ins, kbd, q, samp, small, strong, sub, sup, var, b, i, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary, time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;
        font-size: 100%;
        vertical-align: middle;
        background: transparent;
    }
    *, *::after, *::before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    *, *:after, *:before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    * {
        outline: none!important;
    }
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    user agent stylesheet
    div {
        display: block;
    }
    ul li {
        list-style: none;
    }
    html * {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
</style>
<script language="javascript">
    function validateReview()
    {
        var revie = document.getElementById("add-review").value;
        if (revie == "")
        {
            alert("comments is required.");
            revie.focus( );
            return false;
        }

    }
</script>

<section>
    <div class="container">
        <div class="row">
            <?php include('include/home/sidebar.php'); ?>
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="reservation/img/products/<?php echo $prodimage; ?>" />	
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <h2 class="product"><?php echo $prodname; ?></h2>
                            <p>Category: <?php echo $prodcat; ?></p>

                            <p>Price: <span class="price"><?php echo $prodprice; ?></span></p>

                            <br>

                            <a class="btn btn-default add-to-cart" id="add-to-cart"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
                            <p class="info hidethis" style="color:red;"><strong>Product Added to Cart!</strong></p>
                            <p><b>Description: </b><?php echo $proddesc; ?></p>
                            <p><b>Contact Info:</b> 1234567</p>
                            <p><b>Email:</b> email@domain.com</p>

                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

            </div>
            <style>#recommandlist ul{
                    list-style: none;
                }
                #menu li{
                    display: inline;
                }</style> 
            <div class="row">
             <div id="recommandlist">
                 Recommend  Product(Top  apriori_association_rules) 

                <?php
                $result = mysql_query("select distinct fpgrowth_association_rules.SUP,fpgrowth_association_rules.CONF, products.ID as item_id,products.imgUrl ,products.Product ,products.Price from  fpgrowth_association_rules inner join products on products.ID=fpgrowth_association_rules.RecommendItemCode where fpgrowth_association_rules.ItemIDGroup='$prodID'  ") or die(mysql_error());
                ?>

                <ul>
                   
                    <?php
                    while ($row = mysql_fetch_array($result)) {
                        ?>
                        <li style=" float: left;">
                            <p>SUP:<?php echo $row['SUP']; ?> </p>
                            <a href="product-details.php?prodid=<?php echo $row['item_id']; ?>"><img src="reservation/img/products/<?php echo $row['imgUrl']; ?>" height="100px" width="100px">
                                <br>
                                <span> <?php echo $row['Product']; ?></span><br>
                                <span>Price : <?php echo $row['Price']; ?></span>
                            </a>
                        </li> 

                    <?php } ?>

                </ul>

                
            </div>
            
            </div>
            <div class="row">
            <div id="recommandlist">
                 Recommend  Product(Top  Two Phase) 
                <?php
                $result = mysql_query("select distinct twophase.SUP,twophase.UTIL, products.ID as item_id,products.imgUrl ,products.Product ,products.Price from  twophase inner join products on products.ID=twophase.RecommendItemCode where twophase.ItemIDGroup='$prodID'   order by  (LENGTH(twophase.RecommendItemCode) and twophase.UTIL) desc ") or die(mysql_error());
                ?>

                <ul>
                   
                    <?php
                    while ($row = mysql_fetch_array($result)) {
                        ?>
                        <li style=" float: left;">
                            <p>UTIL:<?php echo $row['UTIL']; ?> </p>
                            <a href="product-details.php?prodid=<?php echo $row['item_id']; ?>"><img src="reservation/img/products/<?php echo $row['imgUrl']; ?>" height="100px" width="100px">
                                <br>
                                <span> <?php echo $row['Product']; ?></span><br>
                                <span>Price : <?php echo $row['Price']; ?></span>
                            </a>
                        </li> 

                    <?php } ?>

                </ul>

                
            </div>
            </div>
            </div>

        <div class="row">

            <div class="gympp-card aml">
                <div class="product-rating-box">
                    <?php
                    $postivevalue = 0;
                    $negativevalue = 0;
                    $mixvalue = 0;
                    //p=(p*100)/(p+n+m)
                    // string select sum(commentvalue) from comment_nlp where commentvalue>0
                    $sqlpositive = "select sum(commentValue) as postive from comments_nlp where commentValue>0 and item_id='$prodID'";
                    $sqlNegative = "select sum(commentValue) as negtive from comments_nlp where commentValue<=0 and item_id='$prodID'";
                    $sqln3 = "select sum(commentValue) as  mixed  from comments_nlp where commentValue=0 and item_id='$prodID'";

                    try {
                        $query = mysql_query($sqlpositive)or die(mysql_error());
                        $row = mysql_fetch_array($query);
                        $postivevalue = $row['postive'];
                       

                        $query = mysql_query($sqlNegative)or die(mysql_error());
                        $row = mysql_fetch_array($query);
                        $negativevalue = $row['negtive'];
                        
                         $query = mysql_query($sqln3)or die(mysql_error());
                        $row = mysql_fetch_array($query);
                        $mixvalue = $row['mixed'];
                        
                    } catch (Exception $e) {
                        echo 'Caught exception: ', $e->getMessage(), "\n";
                    }
                    ?>
                    <h2 class="summary-card__score product__score"><strong class="score__value score-value-6"><?php echo $postivevalue - $negativevalue; ?></strong>/10</h2>		
                    <div class="rating-lines">
                        <div id="skills" class="wow fadeIn" data-delay="0" data-duration="500ms">


                            <progress value='<?php echo $postivevalue; ?>' max="10"></progress><span>Positive  (<?php echo $postivevalue; ?>)</span><br>
                            <progress value='<?php echo abs($negativevalue); ?>' max="10"></progress><span>Negative (<?php echo $negativevalue; ?>)</span><br>
                            <progress value='<?php echo $mixvalue; ?>' max="10"></progress><span>Both (<?php echo $mixvalue; ?>)</span><br>

                        </div>
                    </div>
                    <div class="col-sm-9 padding-left">
                        <ul class="feed-card anx">

                            <li class="product-plan">
                                <div class="grid js-masonry">
                                    <div class="col-sm-12 padding-right">

                                    </div>
                                    <div class="col-sm-12 padding-right">

                                    </div>
                                    <span class="btn btn-primary btn btn-danger all-plan-btn"> Give the Comments </span>
                                </div> 
                            </li>

                            <li class="qf b aml main stamp clearfix" id="addReviewForm">
                                <div class="review-given-item review-given-form">
                                    <div class="">
                                        <div id="review" style="display:none;">Want to write about your experience. Please write your review, we'll be happy to add it.</div>
                                        <div id="reviewContainer">

                                            <form method="post" name="add-review" onsubmit="return validateReview();" id="add-review" action="addComments.php">
                                                <div class="col-sm-12 review-form-heading">Love us, Write a review</div>
                                                <input name="itemid" id="itemid" value="<?php echo $prodID; ?>" type="hidden">
                                                <div class="col-sm-12 margin-b5">
                                                    <textarea name="txtReview" rows="5" id="txtReview" style="width: 100%; min-width: 100%; max-width: 100%; min-height: 170px; font-size: 13px; border: 1px solid #CCCCCC; border-radius: 5px; color: #444343; padding: 10px;" placeholder="Tip: A great review covers equipments, service, and ambiance. Got recommendations for your favourite equipments  and exercises, or something everyone should try here? Include that too! And remember, your review needs to be at least 140 characters long :)"></textarea>
                                                </div>

                                                <div class="col-sm-12">
                                                    <button type="reset" value="Reset" class=" btn btn-primary pull-left btn btn-default cancel-review">Reset</button>

                                                    <input type="submit" id="submit" value="submit" class=" btn btn-primary pull-right btn btn-success " onclick="return validateReview();">
                                                    <div class="clear"></div>
                                                </div>


                                                <div class="clear">

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>  
                            <?php
                            if (!empty($prodID)) {
                                $result = mysql_query("select * from comments_nlp where item_id = '$prodID'") or die(mysql_error());
                                while ($row = mysql_fetch_array($result)) {
                                    ?>
                                    <li class="qf b aml" id="review-9531">
                                        <div style="width: 30px; float: left; height: 39px;">
                                            <div id="divpoint" style="font-size: 15px;  line-height: 28px; width: 28px;
                                                 background-color: rgb(102, 204, 51); -moz-border-radius: 10px; -webkit-border-radius: 10px;
                                                 border-radius: 20px; border: 0px solid; text-align: center;"><?php echo $row['commentValue']; ?>
                                            </div>
                                        </div> 
                                        <div class="qg" style="float: left">
                                            <div class="aoc">
                                                <p style="margin-bottom:10px;font-size:12px;color:black;line-height:1.8;text-align: justify;
                                                   text-justify: inter-word;">
                                                   <?php echo $row['comments']; ?>          
                                                </p>
                                                <div style="float: right; min-width:200px; text-align: justify;font-style: italic;  width: 95%; padding: 1px 0px 10px 5px; font-size: 13px; color: #636363;
                                                     height: auto; overflow:auto;">
                                                    |  <?php echo $row['com_date']; ?>  |                                         
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </li> 
                                    <?php
                                }
                            }
                            ?>


                        </ul>

                    </div> 
                </div>

            </div>
            </section>

            <?php include('include/home/footer.php'); ?>
