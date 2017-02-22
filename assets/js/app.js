/*
	CSGOForms
	App.js
	Version: 1.0
	All rights reserved.
	Author: Forms [github.com/LucasFormiga]
*/


/****************************/
/*         SETTINGS         */
/****************************/
// Configuration
var websiteName = "CSGOForms"; // Website Name
var supportEmail = "support@csgoforms.com"; // Support Email
var botTradeLink = "https://steamcommunity.com/tradeoffer/new/?partner=278478260&token=s8MZ56C5";


// Staff
var administratorID = ['76561198079018592', '76561198007946429'];
var moderatorsID = [];


// Data
var loggedIn = false;
var playerData = [];


// Misc
var timerRunning = false; // Is the timer running?
var timeLeft = 120; // Time remain to game begin if you do not catch up on the necessary items



/****************************/
/*         GET DATA         */
/****************************/
function isLoggedIn()
{
	return this.loggedIn;
}

function isTimerRunning()
{
	return this.timerRunning;
}

function getTimeLeft()
{
	return this.timeLeft;
}


/****************************/
/*         SET DATA         */
/****************************/
function setLoggedStatus(statusBoolean)
{
	this.loggedIn = statusBoolean;
}

function setUserInfo(userInfo)
{
	this.userInfo = userInfo;
}

function setTradeToken(tradeToken)
{
	this.tradeToken = tradeToken;
}

function setTimeLeft(timeLeft)
{
	this.timeLeft = timeLeft;
}

function setTimerRunning(isRunning)
{
	this.timerRunning = isRunning;
}


/****************************/
/*          TIMER           */
/****************************/
function startTimer(timeRemain)
{
	if (!this.isTimerRunning() || this.getTimeLeft() <= 0)
	{
		setTimerRunning(false);
		return;
	}

	if (this.getTimeLeft() !== undefined)
	{
		this.setTimeLeft() = timeRemain;
	}

	//Set something on the page to show the time left
	$('#timer').text(parseInt(this.getTimeLeft()) + 's');

	this.setTimeLeft(this.getTimeLeft()--);

	if (this.getTimeLeft() <= 0)
	{
		this.setTimerRunning(false);
		return;
	}

	setTimeout(startTimer, 1000);
}


/****************************/
/*        FUNCTIONS         */
/****************************/
function handleJsonResponse(jsonObj, callback) {
	if (jsonObj['errCode'] == 1)
	{
		var msg = jsonObj['errMsg'];
		errMsg(msg);
	}
	else
	{
		var data = jsonObj['data'];
		callback(data);
	}
}

function errMsg(message)
{
	if (message === null || message === undefined)
	{
		message = 'An unknown error has occured. Please refresh the page and try again later, if happen again, contact our support at <a href="mailto:' + supportEmail + '>our email</a>."';
	}
	swal('Woops, something went wrong', message, 'error');
}

function successMsg (message)
{
	swal('Success!', message, 'success');
}

function getFormattedDate()
{
	var date = new Date();

	var month = date.getMonth() + 1;
	if (month < 10)
	{
		month = '0' + month;
	}

	return date.getDate() + "/" + month + "/" + date.getFullYear();
}

function getFormattedTime()
{
	var date = new Date();

	return date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
}

function getFormattedPrice(cents)
{
	if (typeof cents !== 'number')
	{
		cents = parseInt(cents);
	}

	var price = cents / 100;
	
	if (cents % 100 === 0)
	{ //If it is an even dollar, add the .00
		price = price + '.00';
	}
	else if (cents % 10 === 0)
	{ //If it is like $3.40, add the trailing 0
		price = price + '0';
	}

	return '$' + price;
}

function playSound(soundId)
{
	var player = $('#' + soundId)[0];
	player.currentTime = 0;
	player.play();
}



/****************************/
/*        READY EVT         */
/****************************/
$(document).ready(function()
{

	$.getJSON('../_app/user.manager.php', function(jsonObj)
	{
		handleJsonResponse(jsonObj, function(data)
		{
			if (data['logged'] === 1)
			{
				loggedIn 				= true;
				playerData['name'] 		= data['name'];
				playerData['avatar'] 	= data['avatar'];

				$('.logout').css('display', 'block');
				$('.avatar').attr('src', playerData['avatar']);
				$('#name').text(playerData['name']);
			}
		});
	});

	$('#profile').click(function()
	{
		$(location).attr('href', '/me.php');
	});

	$('#logout').click(function()
	{
		$(location).attr('href', '/?logout');
	});
});