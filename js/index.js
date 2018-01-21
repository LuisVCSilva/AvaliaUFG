$(function() {
var paper = new Raphael(document.getElementById('canvas_container'), 600, 525);  
  // First convert TABLE data to objects
  var aRows = $('#html5logo tbody tr:not(:first-child)');
  var oData = {devices: []};
  for(var i=0; i<aRows.length; i++) {
    var $this = $(aRows[i]);
    oData.devices[oData.devices.length] = {
      device: $this.find('td:nth-child(1)').text(),
      ratio: $this.find('td:nth-child(5)').text().split(' ')[0]
    };
   //   console.log(i, oData.device, oData.ratio);
  }
  // Okay we got a table of: "Device","ratio"
  // We should now render it to SVG using Raphael
  // I choose to iterate data from 0..number of rows
  // so that we get fastest at bottom and slowest at top
  var height = 40, x = 170, scale=6, devices = oData.devices.length;
  var style = {
    bg: 'rgba(0,0,0,.4)',
    text: 'rgba(16,16,55,.7)',
    value: 'rgba(16,16,0,.8)'
  }
  for(var i=0; i<50; i++) {
    var xx = x+(i*scale);
    var line = paper.path('M '+xx+',15 L '+xx+','+(height*devices*1.115));
    line.attr({'stroke':style.bg});
  }
  for(var i=0; i<devices; i++) {
    var me = oData.devices[i];
    var y = (devices-i)*height;
    var width = x+(me.ratio*scale);
    var rectangle = paper.rect(x, y, 0, height*.9); 
    rectangle.attr({fill: style.bg, stroke: '#ddd', 'stroke-width': 0}); 
    rectangle.animate({"width": width}, 1000*me.ratio/30);
    
    var value = paper.text(width+x+20, y+(height*.5), me.ratio)  
        value.attr({'opacity':0, 'font-size': 12, 'stroke':style.value, 'text-align':'left'})
          value.animate({"opacity": 1}, 2000);
          
    var text = paper.text(90, y+(height*.5), me.device)  
        text.attr({'font-size': 12, 'stroke':style.text, 'width':'100px', 'text-align':'left'})
    
    
  }
})