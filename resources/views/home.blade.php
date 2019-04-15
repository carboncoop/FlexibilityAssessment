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

        <p>Flexibly using electricity to save money for users and make money for community groups</p>
        
        <p>This research project will explore the benefits and possibilities of an energy community aggregation service (ECAS). Want to know more, simply click on the tabs to find out.</p>

        <div id="navigation-buttons">
            <a href="more-about-the-project"><button>About</button></a>

            <a href="how-could-I-benefit-from-flexibility"><button>Benefits for Users</button></a>

            <a href="how-could-my-organisation-benefit-from-flexibility"><button>Benefits for Organisations</button></a> 

            <a href="scotland-potential-flexibility-map"><button>Where is the Flexibility?</button></a> 
            
            <a href="resources-for-community-organisations"><button>Resources for organisations</button></a> 
            
            <a href="privacy-policy"><button>Your Data and Privacy</button></a> 

        </div>

    </div>

@endsection
