window.onload = function() {



        let id = $("[name = 'book_id']");
        let name = $("[name = 'book_name']");
        let publisher = $("[name = 'book_publisher']");
        let price = $("[name = 'book_price']");

        let button_update = $("#btn_update");
        let button_delete = $("#btn_delete");
        let button_create = $("#btn_create");
        let button_read = $("#btn_read");




        $('.edit').parent().click(e => {
            displayData(e);
            //enable the two buttons
            button_update.attr('disabled', false);
            button_delete.attr('disabled', false);
            button_create.attr('disabled', true);
            button_read.attr('disabled', true);




        })


        let displayData = (e) => {

            //for converting from element to jquery object
            let event = $(e.currentTarget);
            console.log(event);

            /// the text and val methodes (almost all methodes) return strings not numbers //not important
            let book_id = event.siblings('.book_id');
            let book_name = event.siblings('.book_name');
            let book_publisher = event.siblings('.book_publisher');
            let book_price = event.siblings('.book_price');
            id.val(parseInt(book_id.text()));
            name.val(book_name.text());
            publisher.val(book_publisher.text());
            price.val(book_price.text().substr(0, book_price.text().length - 1));


        }


    }
    // {}