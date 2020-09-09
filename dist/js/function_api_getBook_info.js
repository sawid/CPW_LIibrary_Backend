function goodRead() {
    // end of service YQL is down
    // note 
    //ref: https://gist.github.com/hitswa/b0d5c161a0507a54d2e4e72b12dd4537 
    //     var key = "PNmXfVCHDRfwYeUC7QOFVQ"; // replace with your key

    //     var url = "https://www.goodreads.com/book/isbn/" + '0070223629' + "?key=" + key;

    //     $.get("http://query.yahooapis.com/v1/public/yql",
    //         {
    //             q: "select * from xml where url=\"" + url + "\"",
    //             format: "json"
    //         },
    //         function (json) {

    //             if (json.query.results.error === "Page not found") {
    //                 console.log("no book found");
    //             } else {

    //                 var book = json.query.results.GoodreadsResponse.book;

    //                 var title = book.title;
    //                 var isbn10 = book.isbn;
    //                 var isbn13 = book.isbn13;
    //                 var country_code = book.country_code;
    //                 var image_url = book.image_url;
    //                 var small_image_url = book.small_image_url;
    //                 var publisher = book.publisher;
    //                 var description = book.description;

    //                 var all_authors = book.authors.author;



    //                 if (book.authors.author.length === undefined) { //single author

    //                     var authors = [all_authors.name];

    //                 } else { // multiple authors

    //                     var author_count = all_authors.length

    //                     var authors = [];

    //                     for (i = 0; i < author_count; i++) {
    //                         authors.push(all_authors[i].name)
    //                     }

    //                 }

    //                 var book_object = {
    //                     "title": title,
    //                     "isbn10": isbn10,
    //                     "isbn13": isbn13,
    //                     "country_code": country_code,
    //                     "image_url": image_url,
    //                     "small_image_url": small_image_url,
    //                     "publisher": publisher,
    //                     "description": description,
    //                     "authors": authors,
    //                 }
    //                 console.log(book_object);
    //                 // return book_object;

    //             }
    //         }
    //     );
}

function step_across(i){
    if(i == 'a'){
        // $('#step_across1').val() = '1';
        document.getElementById("step_across1").value = '1';
        // alert(document.getElementById("step_across1").value);

    }else if(i == 'b'){
        // $('#step_across2').val() = '1';
        document.getElementById("step_across2").value = '1';
        // alert(document.getElementById("step_across2").value);

    }

}
function check_GBc(isbn) {
    // console.log('this functions runs!: check_GBc');
    var datat = "";
    var i = '';
    var googleAPI = "https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn;
    $.getJSON(googleAPI, function (response) {
        console.log(response);
        i = response.totalItems;
        console.log(i);

        if (i.toString() != '0') {
            datat += '<div class="icheck-danger d-block mb-3">';
            datat += '<input type="radio" name="check_input" id="gb_radio" value="1">';
            datat += '<label for="gb_radio">';
            datat += 'ใช่ ต้องการนำเข้าข้อมูลจาก Google Book';
            datat += '</label>';
            datat += '</div>';
        }else{
            datat += '<div class="icheck-danger d-block mb-3">';
            datat += '<input type="radio" disabled name="check_input" id="gb_radio" value="1">';
            datat += '<label for="gb_radio">';
            datat += '<del>นำเข้าข้อมูลจาก Google Book</del> (<code>ไม่พบ</code>)';
            datat += '</label>';
            datat += '</div>';
            // step_across('b');
        }
        // alert(i.toString() != '0');
        // alert(i);
        // console.log('GBC TYPE I ' + typeof i);
        // console.log('GBC VALUE I ' + i);
        $('#get_rad').append(datat);

        // return datat;
    });



}

function check_CLc(isbn) {
    // console.log('this functions runs!: check_CLc');
    var datat = "";
    var i = '';
    $.ajax({
        url: "dist/php/sp_process_add_new_book.php",
        method: "POST",
        data: {
            isbn: isbn,
            actions: 'getCPWLAS'
        },
        success: function (data) {
            
            i = data;
            console.log(data);
            console.log(data != 0);
            if (data != 0) {
                datat += '<div class="icheck-danger d-block mb-3">';
                datat += '<input type="radio" name="check_input" id="cl_radio" value="2">';
                datat += '<label for="cl_radio">';
                datat += 'ใช่ ต้องการนำเข้าจากที่มีอยู่ในห้องสมุดโรงเรียน';
                datat += '</label>';
                datat += '</div>';
            }else{
                datat += '<div class="icheck-danger d-block mb-3">';
                datat += '<input type="radio" name="check_input" disabled id="cl_radio" value="2">';
                datat += '<label for="cl_radio">';
                datat += '<del>นำเข้าจากห้องสมุดโรงเรียน</del> (<code>ไม่พบ</code>)';
                datat += '</label>';
                datat += '</div>';
            }
            $('#get_rad').append(datat);
        }
    });

}

function google_bapi(isbn) {
    console.log('this functions runs!');
    var thumb = "";
    var author = '';
    var description = "";
    var isbn13 = "";
    var title = "";
    var publisher = "";
    var publishedDate = "";
    var categories = "";
    $.ajax({
        url: "https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn, //becomes URL plugged in, and then bookSearch	
        dataType: "json", //give it a type of data
        success: function (json) {  //if this link is legit, and it's JSON, it will pull in data
            if (typeof json.items.volumeInfo.imageLinks != "undefined") {
                thumb = json.items.volumeInfo.imageLinks.Thumbnail;
            }
            // AUTHOR
            if (typeof json.items.volumeInfo.authors != "undefined") {
                author = json.items.volumeInfo.authors[0];
            }

            // description
            if (typeof json.itemsvolumeInfo.description != "undefined") {
                description = json.items.volumeInfo.description;
            }

            if (typeof json.items.volumeInfo.industryIdentifiers != "undefined") {
                isbn13 = json.items.volumeInfo.industryIdentifiers[0].identifier;
            }
            if (typeof json.items.volumeInfo.pageCount != "undefined") {
                pageCount = json.items.volumeInfo.pageCount;
            }
            if (typeof json.items.volumeInfo.title != "undefined") {
                title = json.items.volumeInfo.title;
            }
            if (typeof json.items.volumeInfo.publisher != "undefined") {
                publisher = json.items.volumeInfo.publisher;
            }
            if (typeof json.items.volumeInfo.publishedDate != "undefined") {
                publishedDate = json.items.volumeInfo.publishedDate;
            }
            if (typeof json.items.volumeInfo.categories != "undefined") {
                categories = json.items.volumeInfo.categories;
            }
            // for (i = 0; i < json.items.length; i++) {
            //     if (typeof json.items[i].volumeInfo.imageLinks != "undefined") {
            //         thumb = json.items[i].volumeInfo.imageLinks.smallThumbnail;
            //     } else {
            //         thumb = "http://i.imgur.com/oM3MdAi.png";
            //         //thumb = 'http://slems-oldboys.org.uk/library/wp-content/uploads/2013/11/library_nocover.jpg'
            //     }
            //     // AUTHOR
            //     if (typeof json.items[i].volumeInfo.authors != "undefined") {
            //         author = json.items[i].volumeInfo.authors[0];
            //     }

            //     // description
            //     if (typeof json.items[i].volumeInfo.description != "undefined") {
            //         description = json.items[i].volumeInfo.description;
            //     }

            //     if (typeof json.items[i].volumeInfo.industryIdentifiers != "undefined") {
            //         isbn13 = json.items[i].volumeInfo.industryIdentifiers[0].identifier;
            //     }

            //     htmlcontent +=
            //         "<div class='thumbs'><b>Title:</b> " +
            //         json.items[i].volumeInfo.title +
            //         "</b> " +
            //         '<img src="' +
            //         thumb +
            //         '" + alt="' +
            //         json.items[i].volumeInfo.title +
            //         '">' +
            //         "<br><b>Author: </b>" +
            //         author +
            //         "<br><b>ISBN_13: </b>" +
            //         isbn +
            //         "<br><br>" +
            //         "<b>description:</b> " +


            //         (description, 400) +
            //         "</div>";
            // }
            // document.getElementById("books").innerHTML =
            //     "<div>" + htmlcontent + "</div><br>";
        },
        type: 'GET' //1) GET data
        //2) UPDATE data
        //3) PUSH NEW DATA 
        //4) DELETE DATA
    });

}

function text_s() {
    var isbn = '0070223629';
    var googleAPI = "https://www.googleapis.com/books/v1/volumes?q=" + isbn;
    $.getJSON(googleAPI, function (response) {
        console.log(response);
    });
}