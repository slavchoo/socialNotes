<html>
    <head>
        <title>Sticky Notes Demo</title>    
        <link rel="stylesheet" href="/libs/jqnotes/css/ui-lightness/jquery-ui-1.8.12.custom.css" type="text/css">
        <script type="text/javascript" src="/libs/jqnotes/script/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="/libs/jqnotes/script/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript" src="/libs/jqnotes/script/jquery.stickynotes.js"></script>
        <link rel="stylesheet" href="/libs/jqnotes/css/jquery.stickynotes.css" type="text/css">

    </head>
    <body>
        <h1>Sticky Notes Demo</h1>
        <div id="notes" style="width:800px;height:500px;">
        </div>
        <script type="text/javascript" charset="utf-8">
            var edited = function(note) {
                alert("Edited note with id " + note.id + ", new text is: " + note.text);
            }
            var created = function(note) {
                alert("Created note with id " + note.id + ", text is: " + note.text);
            }
			
            var deleted = function(note) {
                alert("Deleted note with id " + note.id + ", text is: " + note.text);
            }
			
            var moved = function(note) {
                alert("Moved note with id " + note.id + ", text is: " + note.text);
            }	
			
            var resized = function(note) {
                alert("Resized note with id " + note.id + ", text is: " + note.text);
            }					
		
            jQuery(document).ready(function() {
                var options = {
                    notes:[{"id":1,
                            "text":"Test Internet Explorer",
                            "pos_x": 50,
                            "pos_y": 50,	
                            "width": 200,							
                            "height": 200,													
                        }]
                    ,resizable: true
                    ,controls: true 
                    ,editCallback: edited
                    ,createCallback: created
                    ,deleteCallback: deleted
                    ,moveCallback: moved					
                    ,resizeCallback: resized					
					
                };
                jQuery("#notes").stickyNotes(options);
            });
        </script>
    </body>
</html>
