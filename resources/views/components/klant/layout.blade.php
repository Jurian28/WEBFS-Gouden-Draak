<!doctype html>
<html>
<head>
    <title>The Golden Dragon</title>
    <style>
        body {background-color: darkred; margin: 15px; margin-left: 50px; margin-right: 50px}
        td {padding: 0px;}

        @font-face {
            font-family: 'chinese_takeawayregular';
            src: url('{{ asset('fonts/chinesetakeaway-webfont.woff2') }}') format('woff2'),
            url('{{ asset('fonts/chinesetakeaway-webfont.woff') }}') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        a {text-decoration: none;
            color: yellow;}
    </style>
</head>

<body>

<div style="padding: 5px; height: 50px; background: red; display: flex; justify-content: space-evenly">
    <div >
        <img style="vertical-align: middle;" src="{{ asset('images/logos/dragon-small.png') }}" alt="Golden Dragon" height="50px">
        <span style="font-family:'chinese_takeawayregular'; color: yellow; text-align: center; font-size: 30px">De Gouden Draak</span>
        <img style="vertical-align: middle;" src="{{ asset('images/logos/dragon-small-flipped.png') }}" alt="Golden Dragon" height="50px">
    </div>
    <a href="paginas/aanbiedingen.html" style="color:yellow;font-weight:bold;text-decoration: none;">
        <marquee behavior="scroll" direction="left">
            Welkom bij De Gouden Draak. Klik op deze tekst om de aanbiedingen van deze week te zien!
        </marquee>
    </a>
    <div>
        <img style="vertical-align: middle;" src="{{ asset('images/logos/dragon-small.png') }}" alt="Golden Dragon" height="50px">
        <span style="font-family:'chinese_takeawayregular'; color: yellow; text-align: center; font-size: 30px">De Gouden Draak</span>
        <img style="vertical-align: middle;" src="{{ asset('images/logos/dragon-small-flipped.png') }}" alt="Golden Dragon" height="50px">
    </div>
</div>

<table id="main_table" style="padding:5px;width:100%;border-collapse: collapse">
    <tr style="height:7px;background-color:red">
        <td colspan="9">
        </td>
    <tr>
    <tr style="height:25px;background-color:red">
        <td width="7px">
        </td>
        <td style="width:25px;border-left:4px solid yellow;border-top:4px solid yellow"></td>
        <td style="width:25px;border-right:4px solid yellow;border-top:4px solid yellow"></td>
        <td style="width:25px;border-right:4px solid yellow;border-bottom:4px solid yellow"></td>
        <td style="border-top:4px solid yellow;border-bottom:4px solid yellow"></td>
        <td style="width:25px;border-left:4px solid yellow;border-bottom:4px solid yellow"></td>
        <td style="width:25px;border-left:4px solid yellow;border-top:4px solid yellow"></td>
        <td style="width:25px;border-right:4px solid yellow;border-top:4px solid yellow"></td>
        <td width="7px">
    </tr>
    <tr style="height:25px;background-color:red">
        <td width="7px">
        <td style="width:25px;border-left:4px solid yellow;border-bottom:4px solid yellow"></td>
        <td style="width:25px;border:4px solid yellow"></td>
        <td style="width:25px;border:4px solid yellow"></td>
        <td></td>
        <td style="width:25px;border:4px solid yellow"></td>
        <td style="width:25px;border:4px solid yellow"></td>
        <td style="width:25px;border-right:4px solid yellow;border-bottom:4px solid yellow"></td>
        <td width="7px">
    </tr>
    <tr style="height:25px;background-color:red">
        <td width="7px">
        <td style="width:25px;border-right:4px solid yellow;border-bottom:4px solid yellow"></td>
        <td style="width:25px;border:4px solid yellow"></td>
        <td style="width:25px"></td>
        <td></td>
        <td style="width:25px"></td>
        <td style="width:25px;border:4px solid yellow"></td>
        <td style="width:25px;border-bottom:4px solid yellow"></td>
        <td width="7px">
    </tr>
    <tr style="height:50px;background-color:red">
        <td width="7px">
        <td style="width:25px;border-right:4px solid yellow;border-left:4px solid yellow"></td>
        <td style="width:25px;"></td>
        <td style="width:25px;"></td>
        <td style="text-align:center">
            <!-- CONTENT HERE! -->

            <x-klant.navbar></x-klant.navbar>
            <div style='border:1px solid black; background:floralwhite; margin-left: 54px; margin-right: 54px; margin-bottom: 25px'> <br>
                {{ $slot }}
            </div>

            <div style='text-align: center'><a href="paginas/contact_new.html">Naar Contact</a></div>

        </td>
        <td style="width:25px;"></td>
        <td style="width:25px;"></td>
        <td style="width:25px;border-right:4px solid yellow;border-left:4px solid yellow"></td>
        <td width="7px">
    </tr>
    <tr style="height:25px;background-color:red">
        <td width="7px">
        <td style="width:25px;border-right:4px solid yellow;border-top:4px solid yellow"></td>
        <td style="width:25px;border:4px solid yellow"></td>
        <td style="width:25px"></td>
        <td></td>
        <td style="width:25px"></td>
        <td style="width:25px;border:4px solid yellow"></td>
        <td style="width:25px;border-top:4px solid yellow"></td>
        <td width="7px">
    </tr>
    <tr style="height:25px;background-color:red">
        <td width="7px">
        <td style="width:25px;border-left:4px solid yellow;border-top:4px solid yellow"></td>
        <td style="width:25px;border:4px solid yellow"></td>
        <td style="width:25px;border:4px solid yellow"></td>
        <td></td>
        <td style="width:25px;border:4px solid yellow"></td>
        <td style="width:25px;border:4px solid yellow"></td>
        <td style="width:25px;border-right:4px solid yellow;border-top:4px solid yellow"></td>
        <td width="7px">
    </tr>
    <tr style="height:25px;background-color:red">
        <td width="7px">
        </td>
        <td style="width:25px;border-left:4px solid yellow;border-bottom:4px solid yellow"></td>
        <td style="width:25px;border-right:4px solid yellow;border-bottom:4px solid yellow"></td>
        <td style="width:25px;border-right:4px solid yellow"></td>
        <td style="border-top:4px solid yellow;border-bottom:4px solid yellow"></td>
        <td style="width:25px;border-left:4px solid yellow;"></td>
        <td style="width:25px;border-left:4px solid yellow;border-bottom:4px solid yellow"></td>
        <td style="width:25px;border-right:4px solid yellow;border-bottom:4px solid yellow"></td>
        <td width="7px">
    </tr>
    <tr style="height:7px;background-color:red">
        <td colspan="9">
        </td>
    <tr>
</table>
</body>
</html>
