var $container;
var base_url="http://localhost/dell/";
 function postsocial(message,image,viasource) {
            if(viasource=="facebok")
            {
                $.post(base_url+"index.php/hauth/postfb",{message:message,image:image},function(data){
                    console.log(data);
                });
            }
            else if(viasource=="twitter")
            {
                $.post(base_url+"index.php/hauth/posttweet",{message:message},function(data){
                    console.log(data);
                });
            }
        }
function generatemasonry(url, base_url,source) {
    $(document).ready(function () {
        
       

        $container = $('.masonryposts');

        $container.masonry({
            columnWidth: 280,
            itemSelector: '.item'
        });
        var pageno = 1;
        var orderby = "";
        var orderorder = "";
        var maxrow = 20;

        function fillchintandata() {

            $.getJSON(url, {
                search: "",
                pageno: pageno,
                orderby: orderby,
                orderorder: orderorder,
                maxrow: maxrow
            }, function (data) {

                console.log(data);
                createitems(data.queryresult);
               
            });
        };

        function createitems(data) {

            for (var i = 0; i < data.length; i++) {
                
                if (data[i].image != "") {
                    var str = "<div class='item'><div class='image'><img class='img-responsive' src='" + base_url + "uploads/" + data[i].image + "'></div><div class='text'>" + data[i].text + "</div><div class='buttons text-center'><a href='#' class='btn btn-primary'  onclick='postsocial('"+data[i].text+"','','"+source+"')'>Publish</a></div></div>";
                    $container.append(str);
                    var $myimg=$(".item:last");
                    $(".item:last img").load(function () {
                        $container.masonry('appended', $myimg).fadeIn();
                        //$container.masonry('layout');
                    });
                }
                else
                {
                    var str = "<div class='item'><div class='text'>" + data[i].text + "</div><div class='buttons text-center'><a href='#' class='btn btn-primary' onclick='postsocial('"+data[i].text+"','','"+source+"')'>Publish</a></div></div>";
                    $container.append(str);
                    var $myimg=$(".item:last");
                    $container.masonry('appended', $myimg).fadeIn();
                    
                }

            }

        };
        fillchintandata();
    });
}