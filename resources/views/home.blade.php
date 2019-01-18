@extends('layout')

@section('content')

<style>

    #home #navigation-buttons{
        max-width: 625px;
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

    #home button a{    
        color:#ff2712;
    }

    #home button a:hover{    
        text-decoration:none
    }

</style>


    <div id='home'>

        <h1>Energy Community Aggregation Service (ECAS) research project</h1>

        <h2>What is this project? </h2>

        <p style="color: red;">More catching and explanatory title to be agreed</p>
        <p>We are developing a project including a 'demonstration' or research web platform to help community groups and residents understand the coming changes in the energy system in Scotland and the UK. The project also helps to show how these changes might help community groups and residents to reduce fuel costs or earn an income from getting involved in the energy market. We want to test this platform to help us understand what information you (either as a community organisation representative or as a resident) would find helpful to understanding the changes and the likely opportunities. </p>

        <div id="navigation-buttons">
            <button><a href="more-about-the-project">More about the project</a></button>        

            <button><a href="how-could-I-benefit-from-flexibility">How could I benefit from 'flexibility'?</a></button>        

            <button><a href="how-could-my-organisation-benefit-from-flexibility">How could my organisation benefit from 'flexibility'?</a> </button>

            <button><a href="scotland-potential-flexibility-map">Scotland potential flexibility map</a> </button>

        </div>

    </div>

@endsection
