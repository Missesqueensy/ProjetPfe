@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF_8">
        <meta http-equiv="X-UA-Compatibe" content="IE-edge">
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <title>Student dashboard</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            *{
                font-family: sans-serif;
                box-sizing: border-box;
            }
            body{
                margin: 0;
                display: flex;
                 color: #252525;
            }
            aside{
                margin: 0;
                height:100vh;
                width: 300px;
                box-shadow: 0 2p 15px rgba(51,51,51,05);
            }
            aside ul{
                list-style: none;
                margin:0;
                padding: 0;
            }
            aside .header{
                padding: 30px 40px 43px 40px;

            }
            aside .header img{
                height: 32px;
                margin: 15px 0;


            }
            aside ul li{
                margin: 0 20px;
                padding: 13px 20px;
                display: flex;
                align-items: center;
                gap: 15px;
                height: 52px;
            }
            aside ul li label{
                font-size: 15px;
                font-weight: 500;
            }
            
            aside ul li i{
                color:#d473d4 ;
                font-size: 20px;
            }
            aside  hr{
                margin: 10px 20px;
                border: none;
                border-top: 1px solid;
                border-color: #eee;

            }
            .layout-content{
             flex: 1;
             
            }
            .layout-content header{
                display: flex;
                padding: 30 15px;


            }
            .layout-content header img{
                height:90px;
                width: 90px;
                border-radius: 50%;
            }
            .layout-content header .user_informations{
                display: flex;
                gap: 30px;
                
            }
            .layout-content header .user_informations h4{
                font-size: 20px;
                
            }
            .layout-content header .user_informations h4 span{
                color: #9b9b9b;
                
            }

        </style>
     </head>
        <body>
        <aside>
            <div class="header">
                <img src="{{asset('assets/img/logo.jpg')}}" alt="">
            </div>
            <ul>
                <li>
                    <img width="40" height="40" src="https://img.icons8.com/nolan/64/dashboard.png" alt="dashboard"/>
                    <label >Dashboard</label>
                </li>
                
                <li>
                    <img width="40" height="40" src="https://img.icons8.com/nolan/64/guest-male.png" alt="guest-male"/>
                    <label class="active">Mon Profil</label>
                </li>
                <li>
                    <img width="40" height="40" src="https://img.icons8.com/nolan/64/e-learning.png" alt="e-learning"/>
                    <label >Cours inscrits</label>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0,0,256,256">
                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="none" stroke-linecap="none" stroke-linejoin="none" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M33,3h-18c-2.757,0 -5,2.243 -5,5v37l14,-8.5l12.4,9.3l1.6,-37.8c0,-2.757 -2.243,-5 -5,-5z" fill="#d473d4" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter"></path><path d="M28.88,28c-0.16,0 -0.32,-0.038 -0.468,-0.116l-4.404,-2.328l-4.407,2.327c-0.332,0.177 -0.739,0.149 -1.048,-0.07c-0.308,-0.22 -0.465,-0.594 -0.407,-0.968l0.773,-4.987l-3.496,-3.417c-0.268,-0.262 -0.367,-0.652 -0.256,-1.011c0.11,-0.358 0.413,-0.624 0.782,-0.689l4.916,-0.863l2.258,-4.339c0.172,-0.331 0.514,-0.539 0.887,-0.539v0c0.373,0 0.715,0.208 0.888,0.539l2.256,4.339l4.911,0.867c0.369,0.064 0.671,0.331 0.781,0.689c0.111,0.357 0.012,0.748 -0.256,1.01l-3.494,3.416l0.772,4.986c0.058,0.374 -0.1,0.748 -0.408,0.968c-0.173,0.124 -0.376,0.186 -0.58,0.186zM24.008,23.425c0.16,0 0.321,0.039 0.468,0.116l3.111,1.645l-0.547,-3.527c-0.05,-0.319 0.059,-0.643 0.289,-0.868l2.47,-2.414l-3.479,-0.614c-0.307,-0.054 -0.57,-0.247 -0.714,-0.523l-1.596,-3.071l-1.599,3.071c-0.144,0.275 -0.407,0.469 -0.714,0.523l-3.481,0.611l2.47,2.414c0.23,0.226 0.339,0.549 0.289,0.868l-0.548,3.529l3.114,-1.645c0.146,-0.077 0.307,-0.115 0.467,-0.115z" fill="#324561" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter"></path><path d="M24,35.25l-13,9.75" fill="none" stroke="#324561" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M37,8v37" fill="none" stroke="#324561" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></g>
                        </svg>
                    <label >Favoris</label>
                </li>
                <li>
                    <img width="40" height="40" src="https://img.icons8.com/nolan/64/form.png" alt="form"/>
                    <label >Mes formulaires</label>
                </li>
                <li>
                    <img width="40" height="40" src="https://img.icons8.com/stickers/100/quiz.png" alt="quiz"/>
                    <label >Mes évaluations</label>
                </li>
                <li>
                    <img width="40" height="40" src="https://img.icons8.com/color/48/comments--v1.png" alt="comments--v1"/>
                    <label >Mes Commentaires</label>
                </li>

            </ul>
            <hr>
            <ul>
                <li>
                    <i class="fa-solid fa-gear"></i>
                    <label >Paramètres</label>
                </li>
                <li>
                    <i class="fa-regular fa-right-from-bracket"></i>
                    <label >Déconnexion</label>
                </li>

            </ul>
            </aside>
            <div class="layout-content">
            <header>
                <div class="user_informations">
                <img src="{{asset('assets/img/carousel-2.jpg')}}" alt="">
                @if(Auth::check())

                <h4>Bienvenue,{{Auth::user()->name}}!</h4>
                <span>{{Auth::user()->filliere}}</span>
                @else
                <h4>Utilisateur non connecté</h4>
                @endif
                <span>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star"></i>

                </span>
            <span>Productivité: 70%</span>
            </div>
            </header>
            <main></main>
            </div>
        </body>

</html>
