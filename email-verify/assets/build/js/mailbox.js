    var $mailboxNavAside = $('.Mailbox-nav-aside'),
        $mailboxList = $('.Mailbox-list'),
        $mailAnchor = $('.Mail > a'),
        $mailboxToggle = $('#toggle-mailbox-nav'),
        $mailboxReturn = $('#return-mailbox-list > a'),
        mailboxSideLeftClass = 'Mailbox-list--slideLeft';


    function bindMailAnchorEvents(listAction, asideAction) {
        var listAction = listAction || 'add',
            asideAction = asideAction || '';

        $mailAnchor.off('click.MailAnchor');
        $mailAnchor.on('click.MailAnchor', function(e) {
            e.preventDefault();

            if ('add' === listAction) {
                $mailboxList.addClass(mailboxSideLeftClass);
            } else if ('remove' === listAction) {
                $mailboxList.removeClass(mailboxSideLeftClass)
            }

            if ('show' === asideAction) {
                $mailboxNavAside.show();
            } else if ('hide' === asideAction) {
                $mailboxNavAside.hide();
            }
        });
    }

    $mailboxToggle.on('click.MailboxToggle', function(e) {
        e.stopPropagation();
        $mailboxNavAside.toggle();
    });

    $mailboxReturn.on('click.MailboxListReturn', function(e) {
        e.preventDefault();
        $mailboxList.removeClass(mailboxSideLeftClass);
    });

    if ($windowWidth <= 767) {
        bindMailAnchorEvents('add', 'hide');
    }

    if ($windowWidth <= 1200) {
        bindMailAnchorEvents('add');
    }

    $window.on('resize.Mailbox', function() {
        var $_windowWidth = $(this).width();

        if ($_windowWidth <= 767) {
            $mailboxNavAside.hide();
            bindMailAnchorEvents('add', 'hide');
        } else {
            $mailboxList.removeClass(mailboxSideLeftClass);
            $mailboxNavAside.show();
            bindMailAnchorEvents('remove', 'show');
        }

        if ($_windowWidth <= 1200) {
            bindMailAnchorEvents('add');
        } else {
            $mailboxList.removeClass(mailboxSideLeftClass);
            bindMailAnchorEvents('remove');
        }
    });