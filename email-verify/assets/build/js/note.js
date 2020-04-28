    var $noteList = $('.Note-list'),
        $noteAside = $('.Note-aside'),
        $returnNoteList = $('.return-note-list'),
        leftAsideClass = 'Note-aside--slideleft';

    /**
     * Bind click event to .Note item and add or remove class
     * based on given action param
     * @param action
     */
    function bindNoteListEvents(action) {
        var action = action || 'add';

        $noteList.off('click.NoteClick');

        $noteList.on('click.NoteClick', '.Note', function(e){
            e.preventDefault();

            if ('remove' === action) {
                $noteAside.removeClass(leftAsideClass);
            } else if ( 'add' === action ) {
                $noteAside.addClass(leftAsideClass);
            }
            console.log(action);

        });
    }

    $returnNoteList.on('click.NoteListReturn', function(e) {
        e.preventDefault();
        $noteAside.removeClass(leftAsideClass);
    });

    if ($windowWidth <= 767) {
        bindNoteListEvents();
    }

    $window.on('resize.NoteResize', function() {
        if ($(this).width() <= 767) {
            bindNoteListEvents();
        } else {
            $noteAside.removeClass(leftAsideClass);
            bindNoteListEvents('remove');
        }
    });