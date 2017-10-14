<!DOCTYPE html>
<head>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-3.2.1.min.js"></script>
    <meta charset="utf-8" />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Slabo+27px');


        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

        /* credit
        /*https://codepen.io/anon/pen/xXaNar */

        body {
            background-color: orangered;
            font-family: "Roboto", helvetica, arial, sans-serif;
            font-size: 16px;
            font-weight: 400;
            text-rendering: optimizeLegibility;
        }

        div.table-title {
            display: block;
            margin: auto;
            max-width: 600px;
            padding: 5px;
            width: 100%;
        }

        .table-title h3 {
            color: #fafafa;
            font-size: 30px;
            font-weight: 400;
            font-style: normal;
            font-family: "Roboto", helvetica, arial, sans-serif;
            text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
        }


        /*** Table Styles **/


        tr {
            border-top: 1px solid #C1C3D1;
            border-bottom: 1px solid #C1C3D1;
            color: #666B85;
            font-size: 16px;
            font-weight: normal;
            text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
        }

            tr:hover td {
                background: #4E5066;
                color: #FFFFFF;
                border-top: 1px solid #22262e;
            }

            tr:first-child {
                border-top: none;
            }

            tr:last-child {
                border-bottom: none;
            }

            tr:nth-child(odd) td {
                background: #EBEBEB;
            }

            tr:nth-child(odd):hover td {
                background: #4E5066;
            }

            tr:last-child td:first-child {
                border-bottom-left-radius: 3px;
            }

            tr:last-child td:last-child {
                border-bottom-right-radius: 3px;
            }

        td {
            background: #FFFFFF;
            padding: 20px;
            text-align: left;
            vertical-align: middle;
            font-weight: 300;
            font-size: 18px;
            text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #C1C3D1;
        }

            td:last-child {
                border-right: 0px;
            }



        table, th, td {
            padding: 10px;
            border-spacing: 0.5rem;
            border-collapse: collapse;
            margin-left: 30%;
            margin-right: 30%;
        }

        div#expand {
            display: block;
        }

        .header {
            position: absolute;
            right: 0px;
            top: 3px;
        }


        .title {
            font-family: sans-serif;
            color: #9DE79C;
            text-align: center;
        }
        input[class="profButton"],input[class="logoutButton"] {
            margin-right: 3px;
            background-color: #4CAF50;
            border-style: groove;
            border-width: thick;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
        }
        .rectangle {
           background: #e5592e;
           height: 31px;
           position: relative;
           -moz-box-shadow: 0px 0px 4px rgba(0,0,0,0.55);
           box-shadow: 0px 0px 4px rgba(0,0,0,0.55);
           -webkit-border-radius: 3px;
           -moz-border-radius: 3px;
           border-radius: 3px;
           z-index: 500; /* the stack order: foreground */
           margin: 0;
        }


        .rectangle2 {
           background: #e5592e;
           position: relative;
           -moz-box-shadow: 0px 0px 4px rgba(0,0,0,0.55);
           box-shadow: 0px 0px 4px rgba(0,0,0,0.55);
           z-index: 500; /* the stack order: foreground */
           width: 100px;
           height: 100px;
           margin-right: 150px;
           float: right;
        }
    </style>


</head>
<body>


    <script type="text/javascript" src="../js/RequestForm.js">
    </script>

    <div class="rectangle">
    <div class="header">
        <input class="profButton" type="button" value="My Profile" onclick="profile()">
        <input class="logoutButton" type="button" value="Logout" onclick="log_out()"/>
    </div>
    </div>
    <div class="title"><h1>ASSETSHUB</h1></div>


    <div>
        <table id="requestTable">
            <tr>
                <td>Request Name</td>
                <td>Organization</td>
                <td>Reward</td>
                <td>Needed By</td>
                </td>
            </tr>
            <p class="rectangle2">
    </p>
        </table>

    </div>

    <div id="requestDetails">
        <!-- Content Goes here -->
    </div>
    <div style="text-align:center;">
        <input type="button" value="Submit Request"
    onclick="request_form()"/>
    </div>

    <div>
    </div>

    <script>
        jQuery.get('requests.txt', function(data) {
            var arr = data.split(":");
            var requests = createRequestsFromFile(arr);
        for (i = 0; i < requests.length; i++) {

            var table = document.getElementById("requestTable");
            var row = table.insertRow(table.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3); // the date
            var cell5 = row.insertCell(4); // the details button
            var cell6 = row.insertCell(5); // submit button

            cell1.innerHTML = requests[i][0];
            cell2.innerHTML = requests[i][1];
            cell3.innerHTML = requests[i][2];
            cell4.innerHTML = format_date(requests[i][3]);

            var details = requests[i][4];
            var detailLink = document.createElement("a");
            detailLink.setAttribute("href", details)
            var linkText = document.createTextNode("Details");
            detailLink.appendChild(linkText);
            // Add the link to the previously created TableCell.
            cell5.appendChild(detailLink);
            var submitButton = document.createElement("input");
            submitButton.type = "Button";
            submitButton.value = "Take Request";
            submitButton.setAttribute("onclick", "submit_form()");
            cell6.appendChild(submitButton);
        }
        });
        function show(message) {
            //Function content goes here
            document.getElementById("requestDetails").innerHTML = message;

            if (document.getElementById('requestDetails').style.display == 'none') {
                document.getElementById('requestDetails').style.display = 'block';
            } else {
                document.getElementById('requestDetails').style.display = 'none';
            }
        }

        function format_date(date) {
            return (date.getMonth() + 1) +
                "/" + date.getDate() +
                "/" + date.getFullYear();
        }

        function log_out() {
            window.location.href = "MainPageUnlogged.html"
        }

        function profile() {
            window.location.href = "Profile.html"
        }

        function submit_form() {
            window.location.href = "SubmitForm.html"
        }
        function get_requests() {


            var requests;
            requests = [
            ];
            requests.push(
                ["Horse model", "VGDev", 50, new Date("12/22/2017"), "../DetailsPages/DetailsHorse.html"]
            );
            requests.push(
                ["Dog model", "VGDev", 50, new Date("12/22/2018"), "../DetailsPages/DetailsDog.html"]
            );
            return requests;
        }
        function createRequestsFromFile(arr) {
            var requests = [];
            for (i = 0; i < arr.length - 1; i+=3) {
                requests.push([arr[i], "VGDev", arr[i + 1], new Date("12/22/2018"), arr[i + 2]]);
            }
            return requests;
        }



    </script>

</body>