    $(document).on('submit','#del_post',function(e){
      e.preventDefault();
      var result = confirm("Do you Want to delete this post?");
        if (result) {
          $.ajax({url: "../gostalker/configs/de_post.php", type: "POST", data: new FormData(this), contentType: false, cache: false, processData:false, beforeSend:function(wait){},
          success:function(response){
            $(this).closest('.post-section').fadeOut(1000);
          },
          error:function(error){ $('#main-wait').hide(); $('#main-error').show(); }
        });
        }
      });
