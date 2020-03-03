var express = require('express');
var app = express();
var handlebars = require('express-handlebars').create({defaultLayout:'main'});

var bodyParser = require('body-parser');
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

app.engine('handlebars', handlebars.engine);
app.set('view engine', 'handlebars');
app.set('port', 31930);

app.get('/home', function(req,res){
	res.sendFile('home.html',{root: __dirname });
});

app.get('/about', function(req,res){
	res.sendFile('about.html', {root: __dirname });
});

app.get('/cats', function(req,res){
	res.sendFile('cats.html', {root: __dirname });
});

app.get('/contact', function(req,res){
	res.sendFile('contact.html', {root: __dirname });
});

app.use(function(req,res){
  res.status(404);
  res.render('404');
});

app.use(function(err, req, res, next){
  console.error(err.stack);
  res.type('plain/text');
  res.status(500);
  res.render('500');
});

app.listen(app.get('port'), function(){
  console.log('Express started on http://flip2.engr.oregonstate.edu:' + app.get('port') + '; press Ctrl-C to terminate.');
});