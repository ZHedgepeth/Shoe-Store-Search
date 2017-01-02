# _Shoe Store_

#### By: _Zachary Hedgepeth_

## Description

_A program to list out local shoe stores and the brands of shoes they carry._

## Setup/Installation Requirements

* _Navigate to the directory where you would like your project to reside_

* _Open your terminal and execute: git clone https://github.com/ZHedgepeth/shoe-store-finder_

* _Navigate to the main directory of the project "shoe-store-finder" and in the terminal execute this command: composer install_

* _Open MAMP and select preferences then set shoe-store-finder as the Document Root_

* _Navigate to the "web" directory in shoe-store-finder and execute this command in the terminal: php -S localhost:8000_

* _To view the site open your browser and type http://localhost:8000 to view the project_

## MySQL Commands:
* _CREATE DATABASE shoes;_
* _USE shoes;_
* _CREATE TABLE stores (name VARCHAR (255), S_Id serial PRIMARY KEY);_
* _CREATE TABLE brands (name VARCHAR (255), B_Id serial PRIMARY KEY);_
* _CREATE TABLE brands_stores (S_Id INT, B_Id INT, J_Id serial PRIMARY KEY);_

## Known Bugs

_Timezone error_

## Support and Contact Details

_Contact me at: Zhedgepeth1124@gmail.com_

## Technologies Used

* _MAMP_
* _twig_
* _silex_
* _phpunit_

### License
_Epicodus License   Copyright (c) 2016 Zachary Hedgepeth_
