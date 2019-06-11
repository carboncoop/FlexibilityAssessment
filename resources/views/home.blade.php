@extends('layout')

@section('style')

<style>

    #home #navigation-buttons{
        max-width: 725px;
        text-align:center;
        margin:auto;
    }

    #home button{
        width:280px;
        height:150px;
        font-size:25px;
        margin:15px;
        display: inline-block;
        vertical-align: top;
    }

    #home button{    
        color:#305698;
        cursor:pointer;
    }

    #home button a:hover{    
        text-decoration:none
    }

</style>

@endsection



@section('content')

<div id='home'>

    <h1>Flexible Power</h1>

    <p>Flexible Power Community is a new project which encourages householders and community groups to take ownership of the benefits available from power companies for being more flexible with electricity use at home.</p>
    <p>Renewable electricity is now playing a crucial role in helping tackle climate change and building a sustainable society, and we are using more electricity than ever before; with the growth of gadgets, and gas boilers soon to be prohibited from new builds as the number of electric cars grows.</p>
    <p>But there’s a problem. Renewable energy comes from the wind, the rain, and the sun, but we can’t control the weather. Electricity generation needs to match electricity use at all times, but we can’t turn the wind up and down on demand. The answer is to be more flexible in when we use electricity.</p>
    <p>Being flexible in your use of electricity means using smart appliances, and agreeing  to let the power company remotely switch some of these (such as emersion heaters or storage heaters) on and off at different times to match when renewable energy is available. You'll earn an income from the power companies as a thank you. </p>
    <p>Flexibility is only valuable to the grid in big amounts, so needs to be ‘aggregated’ by organisations representing many households. The Flexible Power Community believes that a community owned aggregator can support energy users to understand how they can get a deal which suits them and makes the most of their flexibility. </p>

    <div id="navigation-buttons">
        <a href="about"><button>About</button></a>

        <a href="benefits-for-users"><button>Benefits for users</button></a>

        <a href="benefits-for-organisations"><button>Benefits for organisations</button></a> 

        <a href="where-is-the-flexibility"><button>Where is the flexibility?</button></a> 

        <a href="resources-for-organisations"><button>Resources for organisations</button></a> 

        <a href="your-data-and-privacy"><button>Your data and privacy</button></a> 

    </div>

</div>

@endsection
