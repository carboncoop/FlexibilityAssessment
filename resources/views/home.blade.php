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
        color:#ff2712;
        cursor:pointer;
    }

    #home button a:hover{    
        text-decoration:none
    }

</style>

@endsection



@section('content')

    <div id='home'>

        <h1>Energy Community Aggregation Service (ECAS) research project</h1>

        <h2>What is this project? </h2>

        <p style="color: red;">More catching and explanatory title to be agreed</p>
        <p>We are developing a project including a 'demonstration' or research web platform to help community groups and residents understand the coming changes in the energy system in Scotland and the UK. The project also helps to show how these changes might help community groups and residents to reduce fuel costs or earn an income from getting involved in the energy market. We want to test this platform to help us understand what information you (either as a community organisation representative or as a resident) would find helpful to understanding the changes and the likely opportunities. </p>

        <div id="navigation-buttons">
            <a href="more-about-the-project"><button>More about the project</button></a>

            <a href="how-could-I-benefit-from-flexibility"><button>How could I benefit from 'flexibility'?</button></a>

            <a href="how-could-my-organisation-benefit-from-flexibility"><button>How could my organisation benefit from 'flexibility'?</button></a> 

            <a href="scotland-potential-flexibility-map"><button>Glasgow and Scotland potential flexibility</button></a> 
            
            <a href="resources-for-community-organisations"><button>Resources for community organisations</button></a> 
            
            <a href="privacy-policy"><button>Privacy policy</button></a> 

        </div>

    </div>

@endsection
