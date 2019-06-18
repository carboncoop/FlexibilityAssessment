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
    <p>Flexible Power Community is a new project which encourages householders and community groups to take ownership of the benefits available from power companies for being more flexible in your power use.</p>
    <p>Renewable electricity is now playing a crucial role in helping tackle climate change and building a sustainable society. We are using electricity more than ever before; in everything from electric heaters to cars. </p>
    <p>But there’s a problem. Renewable energy comes from the wind, the rain, and the sun, but we can’t control the weather. Ideally, the electricity generated needs to match electricity use at all times, but we can’t turn the wind up and down on demand. The answer is to be more flexible in when we use electricity, using it when it is available.</p>
    <p>By agreeing to let your devices shift when they charge to make the best use of the renewable energy available on the grid, you’ll become a part of the smart, sustainable grid we need to build. And you’ll earn an income from the power companies in return.</p>
    <p>But flexibility is only valuable to the grid in big amounts, so each household’s flexibility needs to be added up with others’ flexibility or ‘aggregated’. This aggregation could be done by private companies or community organisations. Flexible Power Community is a demonstration of how a community based aggregator could work. We want to help households to benefit more from flexibility by having a community owned aggregator which helps energy users understand how to get a suitable flexibility deal from the power companies and passes on more of the flexibility fee to the household rather than retaining profits. </p>

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
