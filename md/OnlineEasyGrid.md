# Online Easy Grid

.row
  h4.col.s12.m4 Grid 1st : 
  .col.s12.m8
    p.row
      label.col.s3.m3(for="inputGrid") size(px)
      [input.col.s9.m3(id="inputGrid"type="text"maxlength="3"value="10")]
    p.row
      label.col.s3.m3(for="inputColor") color
      [input.col.s9.m3(id="inputColor"type="color"maxlength="7"value="#ccdddd")]
.row
  h4.col.s12.m4 Grid 2nd : 
  .col.s12.m8
    p.row
      label.col.s3.m3(for="inputGrid2") size(px)
      [input.col.s9.m3(id="inputGrid2"type="text"maxlength="3"value="100")]
    p.row
      label.col.s3.m3(for="inputColor2") color
      [input.col.s9.m3(id="inputColor2"type="color"maxlength="7"value="#66dddd")]
.row
  h4.col.s12.m4 Image file : 
  .col.s12.m8
    p.row
      [input.col.s9.m12(id="inputFile"type="file"accept="image/*")]
.row
  [input.center.col.s12.m4.btn(id="inputPrev"type="button"value="Preview")]

#wrap(style="position:relative;overflow:scroll")
  img#prevImg
  #prevGrid(style="position:absolute;top:0")


script
  $$('title').text('Online Easy Grid | @Bamboo');

  window.onload = function(){
    $$('#inputPrev').on('click', function(){
      var file = $$('#inputFile').prop('files')[0];
      if(!file || file.length == 0){
        alert('Please select file.');
        return;
      }
      var fr = new FileReader();
      var img = new Image();
      
      fr.onloadend = function(){
        img.src = fr.result; 
        img.onload = function(){
          $$('#prevImg').attr('src', fr.result).css({
            'width': img.naturalWidth,
            'height': img.naturalHeight
          });
          $$('#prevGrid').empty().attr({
            'width': img.naturalWidth,
            'height': img.naturalHeight
          });

          var draw = SVG('prevGrid').size(img.naturalWidth, img.naturalHeight);
          for(var x=0; x < img.naturalWidth; x+=parseInt($$('#inputGrid').val())){
            draw.line(x, 0, x, img.naturalHeight).stroke({
              width: 0.3,
              color: $$('#inputColor').val()
            });
          }
          for(var x=0; x < img.naturalWidth; x+=parseInt($$('#inputGrid2').val())){
            draw.line(x, 0, x, img.naturalHeight).stroke({
              width: 0.3,
              color: $$('#inputColor2').val()
            });
          }
          for(var y=0; y < img.naturalHeight; y+=parseInt($$('#inputGrid').val())){
            draw.line(0, y, img.naturalWidth, y).stroke({
              width: 0.3,
              color: $$('#inputColor').val()
            });
          }
          for(var y=0; y < img.naturalHeight; y+=parseInt($$('#inputGrid2').val())){
            draw.line(0, y, img.naturalWidth, y).stroke({
              width: 0.3,
              color: $$('#inputColor2').val()
            });
          }
        };
      };
      fr.readAsDataURL(file);
    });
  };
