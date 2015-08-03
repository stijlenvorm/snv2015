<script type="text/javascript">
    jQuery(document).ready(function($) {
        url = 'https://stijlenvorm.nl/feed';
        $.ajax({
            type: "GET",
            url: document.location.protocol + '//ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=1000&callback=?&q=' + encodeURIComponent(url),
            dataType: 'json',
            error: function(){
                alert('Unable to load feed, Incorrect path or invalid feed');
            },
            success: function(xml){
                values = xml.responseData.feed.entries;
                if(typeof values !== 'undefined') {
                    printList(values)
                }
            }
        });

        function printList(items)
        {
            var holder = $('#snvWidgetGlobalList');
                holder.html('');

            for (var i = 0; i < items.length; i++) {
                var item = items[i];
                var title = '<a href="'+item.link+'" target="_blank"><h4>'+item.title+'</h4></a>';
                var content = '';
                if( i===0 ) {
                    content = item.content;
                }
                holder.append('<li>' + title + content + '</li>');
            };

        }
    });
</script>


<ul id="snvWidgetGlobalList">
<div class="spinnerrr">
  <div class="rect1"></div>
  <div class="rect2"></div>
  <div class="rect3"></div>
  <div class="rect4"></div>
  <div class="rect5"></div>
</div>
</ul>