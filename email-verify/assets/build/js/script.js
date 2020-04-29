    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    /**
     * Cache panel
     * @type {*|HTMLElement}
     */
    var $panel = $('.panel');

    /**
     * Collapse the panel once clicked on the collapse button
     */
    $panel.on('click.PanelCollapse', '.collapse-box', function(e) {
        var $this = $(this), // clicked element
            $thisPanel = $(e.delegateTarget),
            $thisPanelHead = $thisPanel.find('.panel-heading'),
            $thisPanelBody = $thisPanel.find('.panel-body');

        if ($this.hasClass("fa-chevron-down")) {
            $this.removeClass("fa-chevron-down").addClass("fa-chevron-up");
            $thisPanelHead.removeClass('panel-border');
            $thisPanelBody.slideUp(200);
        } else {
            $this.removeClass("fa-chevron-up").addClass("fa-chevron-down");
            $thisPanelHead.addClass('panel-border');
            $thisPanelBody.slideDown(200);
        }
    });

    /**
     * Delete the panel once clicked on the close button
     */
    $panel.on('click.PanelDestroy', '.close-box', function(e) {
        $(e.delegateTarget).remove();
    });

    /**
     * Refresh the panel once clicked on the refresh button
     */
    $panel.on('click.PanelRefresh', '.refresh-box', function(e) {
        e.preventDefault();

        var $thisPanel = $(e.delegateTarget),
            $refreshBlock = $("<div class='refresh-block'><span class='refresh-loader'><i class='fa fa-spinner fa-spin'></i></span></div>");

        $refreshBlock.appendTo($thisPanel);

        setTimeout(function() {
            $thisPanel.find('.refresh-block').remove();
        }, 1000);
    });

    /**
     * Resize all textarea with .autosize class
     */
    autosize($('.autosize'));

    /**
     * Initialize Nice Scroll with .niceScroll class
     */
    $(".niceScroll").niceScroll({
        zindex: "10",
        cursorwidth: "8px",
        cursoropacitymax: 0.3,
        cursorcolor: "#000000",
        cursordragontouch: true,
        cursorborderradius: "10px",
        cursorborder: "2px solid transparent"
    });