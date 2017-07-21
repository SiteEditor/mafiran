/**
 * Created by mohhamad on 10/19/2016.
 */
(function( $ ) {

    var mixIn = function(){

        var UNDEF,
            _hasDontEnumBug,
            _dontEnums;


        function get(obj, prop){
            var parts = prop.split('.'),
                last = parts.pop();

            while (prop = parts.shift()) {
                obj = obj[prop];
                if (typeof obj !== 'object') return;
            }

            return obj[last];
        }

        function checkDontEnum(){
            _dontEnums = [
                'toString',
                'toLocaleString',
                'valueOf',
                'hasOwnProperty',
                'isPrototypeOf',
                'propertyIsEnumerable',
                'constructor'
            ];

            _hasDontEnumBug = true;

            for (var key in {'toString': null}) {
                _hasDontEnumBug = false;
            }
        }

        /**
         * Similar to Array/forEach but works over object properties and fixes Don't
         * Enum bug on IE.
         * based on: http://whattheheadsaid.com/2010/10/a-safer-object-keys-compatibility-implementation
         * @version 0.2.0 (2012/10/30)
         */
        function forIn(obj, fn, thisObj){
            var key, i = 0;
            // no need to check if argument is a real object that way we can use
            // it for arrays, functions, date, etc.

            //post-pone check till needed
            if (_hasDontEnumBug == null) checkDontEnum();

            for (key in obj) {
                if (exec(fn, obj, key, thisObj) === false) {
                    break;
                }
            }

            if (_hasDontEnumBug) {
                while (key = _dontEnums[i++]) {
                    // since we aren't using hasOwn check we need to make sure the
                    // property was overwritten
                    if (obj[key] !== Object.prototype[key]) {
                        if (exec(fn, obj, key, thisObj) === false) {
                            break;
                        }
                    }
                }
            }
        }

        function exec(fn, obj, key, thisObj){
            return fn.call(thisObj, obj[key], key, obj);
        }

        function forOwn(obj, fn, thisObj){
            forIn(obj, function(val, key){
                if (hasOwn(obj, key)) {
                    return fn.call(thisObj, obj[key], key, obj);
                }
            });
        }

        function hasOwn(obj, prop){
            return Object.prototype.hasOwnProperty.call(obj, prop);
        }

        /**
         * Combine properties from all the objects into first one.
         * - This method affects target object in place, if you want to create a new Object pass an empty object as first param.
         * @param {object} target    Target Object
         * @param {...object} objects    Objects to be combined (0...n objects).
         * @return {object} Target Object.
         * @version 0.1.4 (2012/10/29)
         */
        function mixIn(target, objects){
            var i = 0,
                n = arguments.length,
                obj;
            while(++i < n){
                obj = arguments[i];
                if (obj != null) {
                    forOwn(obj, copyProp, target);
                }
            }
            return target;
        }

        function copyProp(val, key){
            this[key] = val;
        }

        return mixIn;

    }();

    var Point = function(x,y){

        //position
        this.x = x||0;
        this.y = y||0;

        //left normal
        this.lx = 0;
        this.ly = 0;

        //right normal
        this.rx = 0;
        this.ry = 0;

        this.angle = 0;

        this.radius = 0;
        this.baseAngle = 0;
        this.oscillationSpeed = 1;


        //elasticty

        this.elasticity = 10;
        this.viscosity = 0.25;
        this.damping = 0.1;
        this.stiffness = 0.1;

        this.origin = {x:this.x, y:this.y};
        this.delta = {x:0, y:0};
        this.offset = {x:0, y:0};

        this.fixed = false;


        //methods
        this.update = function( mouse, dist, width )
        {
            if( mouse == null ) return;

            if( this.fixed )
            {
                this.x = this.origin.x;
                this.y = this.origin.y;
                return;
            }

            this.offset.x += ( this.origin.x - this.x ) / this.elasticity;
            this.offset.y += ( this.origin.y - this.y ) / this.elasticity;

            var dx = this.delta.x = this.x - mouse.x;
            var dy = this.delta.y = this.y - mouse.y;
            var length = Math.sqrt( dx*dx + dy*dy );

            if( length < this.radius ){

                var multiplier = Math.abs( length - this.radius ) / width;

                var a = Math.atan2( this.delta.y, this.delta.x );
                this.offset.x += ( Math.cos( a ) * this.radius - this.delta.x ) * ( 1 - this.damping ) * multiplier;
                this.offset.y += ( Math.sin( a ) * this.radius - this.delta.y ) * ( 1 - this.damping ) * multiplier;
            }

            this.offset.x *= ( 1 - this.viscosity );
            this.offset.y *= ( 1 - this.viscosity );

            if ( Math.abs( this.offset.x ) < .001){

                this.offset.x = 0;
            }

            if ( Math.abs( this.offset.y ) < .001){

                this.offset.y = 0;
            }
            this.x += this.offset.x * this.stiffness;
            this.y += this.offset.y * this.stiffness;

        }

    };

    var Circle = function(){


        function Circle( cfg ){

            this.points = [];
            this.direction = 1;
            this.lastOscillationValues = {min:-1,max:-1};
            if( cfg != null ) this.init( cfg );
        }

        function init( cfg, reset ){

            //init properties
            if( reset == null )this.setProperties( cfg );

            //create points
            var step = PI2 / this.pointCount;
            var angle = Math.random() * PI2;

            this.points = [];
            for( var i = 0; i < this.pointCount; i++ )
            {

                var p = new Point( 0,0 );

                angle += step;
                p.angle = angle;

                p.baseAngle = Math.random() * PI2;

                p.oscillationSpeed = this.oscillation.min + Math.random() * this.oscillation.max;

                p.radius = this.radiusIn + ( .5 + ( .5 *  Math.cos( p.baseAngle ) ) ) * ( this.radiusOut - this.radiusIn );

                p.radiusMouse = this.radiusMouse;
                p.elasticity = this.elasticity;
                p.viscosity  = this.viscosity;
                p.damping = this.damping;
                p.stiffness = this.stiffness;
                this.points.push( p );

            }

            if( this.lastOscillationValues.min != this.oscillation.min
                ||  this.lastOscillationValues.max != this.oscillation.max )
            {
                this.resetOscillationSpeed();
            }

        }
        function resetOscillationSpeed() {


            for (var i = 0; i < this.pointCount; i++) {
                var p = this.points[i];
                p.oscillationSpeed = this.oscillation.min + Math.random() * this.oscillation.max;
            }
            this.lastOscillationValues.min = this.oscillation.min;
            this.lastOscillationValues.max = this.oscillation.max;

        }

        function setProperties( cfg ){

            mixIn( this, cfg );

            var p = this.points[ 0 ];
            if( cfg.pointCount != this.points.length
                ||  cfg.radiusMouse != p.radiusMouse
                ||  cfg.elasticity != p.elasticity
                ||  cfg.viscosity != p.viscosity
                ||  cfg.damping != p.damping
                ||  cfg.stiffness != p.stiffness
            )this.init( cfg, true );

            if( this.lastOscillationValues.min != this.oscillation.min
                ||  this.lastOscillationValues.max != this.oscillation.max )
            {
                this.resetOscillationSpeed();
            }
        }


        function update( mouseX, mouseY )
        {

            var scope  = this;

            var mouse = { x:mouseX, y:mouseY };

            var dx = mouse.x;
            var dy = mouse.y;
            var dist = Math.sqrt( dx*dx + dy*dy );



            this.points.forEach( function( p, i, a ){

                p.angle += scope.speed;// * scope.direction;
                p.radius = scope.radiusIn + ( .5 + ( .5 *  Math.sin( p.baseAngle ) ) ) * ( scope.radiusOut - scope.radiusIn );
                p.baseAngle += p.oscillationSpeed;

                var x = p.origin.x = Math.cos( p.angle ) * p.radius;
                var y = p.origin.y = Math.sin( p.angle ) * p.radius;

                //update point
                p.update( mouse, dist, Math.abs( scope.radiusOut - scope.radiusIn ) );

                //evaluates normal length
                var n = a[ ( i + 1 ) % a.length ];
                var dx = p.x - n.x;
                var dy = p.y - n.y;

                var d = .35 * Math.sqrt( dx*dx + dy*dy );

                p.lx = p.x + Math.cos( p.angle + HPI ) * d;
                p.ly = p.y + Math.sin( p.angle + HPI ) * d;
                p.rx = p.x + Math.cos( p.angle - HPI ) * d;
                p.ry = p.y + Math.sin( p.angle - HPI ) * d;

            } );

        }

        function render( ctx )
        {

            ctx.beginPath();

            this.points.forEach( function( p, i, a ){

                var n = a[ ( i + 1 ) % a.length ];
                ctx.lineTo( p.x, p.y);
                ctx.bezierCurveTo(  p.lx, p.ly, n.rx, n.ry, n.x, n.y );

            });

            ctx.closePath();

            ctx.globalAlpha = this.alpha;

            if( this.fill == true ){

                ctx.globalCompositeOperation = this.fillBlendMode;
                ctx.fillStyle = this.fillColor;
                ctx.fill();
                ctx.globalCompositeOperation = "source-over";
            }

            if( this.stroke == true )
            {
                ctx.lineWidth = this.lineWidth;
                ctx.globalCompositeOperation = this.strokeBlendMode;
                ctx.strokeStyle = this.strokeColor;
                ctx.stroke();
                ctx.globalCompositeOperation = "source-over";
            }

            ctx.globalAlpha = 1;

            if( this.debug )
            {
                ctx.strokeStyle = "#F00";
                ctx.beginPath();
                this.points.forEach( function(p, i, a)
                {
                    //evaluates normal length
                    var n = a[ ( i + 1 ) % a.length ];
                    var dx = p.x - n.x;
                    var dy = p.y - n.y;
                    var d = .35 * Math.sqrt( dx*dx + dy*dy );

                    var lx = p.x + Math.cos( p.angle + HPI ) * d;
                    var ly = p.y + Math.sin( p.angle + HPI ) * d;
                    var rx = p.x + Math.cos( p.angle - HPI ) * d;
                    var ry = p.y + Math.sin( p.angle - HPI ) * d;

                    ctx.moveTo( 0,0 );
                    ctx.lineTo(p.x, p.y );
                    ctx.lineTo( lx, ly );
                    ctx.moveTo(p.x, p.y );
                    ctx.lineTo( rx, ry );

                });
                ctx.stroke();
            }

        }

        var _p = Circle.prototype;
        _p.init = init;
        _p.resetOscillationSpeed = resetOscillationSpeed;
        _p.setProperties = setProperties;
        _p.update = update;
        _p.render = render;
        return Circle;

    }();

    var Blob = function( exports )
    {
        //constants
        window.PI = Math.PI;
        window.HPI = PI / 2;
        window.PI2 = PI * 2;
        window.RAD = PI / 180;

        //default config
        var defaultCfg = {

            // render properties
            stroke : true,
            strokeColor : "#000",
            strokeBlendMode : "source-over",

            fill : false,
            fillColor : "#FFF",
            fillBlendMode : "source-over",

            alpha : 1,
            lineWidth : 1,

            //circles properties
            pointCount: 12,
            radius : { in:.9, out:.95 },
            radiusIn : 200,
            radiusOut : 250,

            //motion
            speed : 0,
            oscillation : { min : RAD, max: 3 * RAD },

            //interaction properties
            viscosity :  .85,
            elasticity : .5,
            damping :    .5,
            stiffness :  .1

        };

        function Blob( _canvas ){

            //rendering
            this.canvas = _canvas;
            this.ctx = this.canvas.getContext( "2d" );

            //circles' management
            this.config = {};
            this.circles = [];
            this.circleCount = 1;
        }

        function init( count, cfg ){


            this.circleCount = count || 1;

            if( cfg == null ) this.config = mixIn( this.config, defaultCfg );
            else this.config = mixIn( this.config, defaultCfg, cfg );

            //console.log( 'properties' );
            //console.log( this );

            this.computeRadius();

            this.circles = [];
            for( var i = 0; i < this.circleCount; i++ )
            {
                var circle = new Circle( this.config );
                circle.direction *= ( i % 2 == 0 ) ? - 1 : 1;
                this.circles.push( circle );
            }


        }

        //discretize radius In & Out
        function computeRadius(){

            var radius = Math.min( this.canvas.width, this.canvas.height ) / 2;

            this.config.radiusIn  = radius * this.config.radius.in;
            this.config.radiusOut = radius * this.config.radius.out;

        }


        function update( mouseX, mouseY, clear ){

            if( clear == null )this.ctx.clearRect( 0, 0, this.canvas.width, this.canvas.height );

            this.ctx.save();
            this.ctx.translate( this.canvas.width/2, this.canvas.height/2 );

            this.computeRadius();

            var scope = this;
            this.circles.forEach( function( c ) {

                c.setProperties( scope.config );
                c.update( mouseX - scope.canvas.width / 2, mouseY - scope.canvas.height / 2 );
                c.render( scope.ctx );

            });

            //this.ctx.beginPath();
            //this.ctx.arc( mouseX - scope.canvas.width / 2, mouseY - scope.canvas.height / 2, 10, 0, PI2 );
            //this.ctx.stroke();

            this.ctx.restore();

        }

        var _p = Blob.prototype;
        _p.init = init;
        _p.update = update;
        _p.computeRadius = computeRadius;
        return Blob;

    }( {} );

    var initBalls = function() {

        (function(global) {(function() {if (global.requestAnimationFrame) {return;} if (global.webkitRequestAnimationFrame) {global.requestAnimationFrame = global[ 'webkitRequestAnimationFrame' ]; global.cancelAnimationFrame = global[ 'webkitCancelAnimationFrame' ] || global[ 'webkitCancelRequestAnimationFrame' ];} var lastTime = 0; global.requestAnimationFrame = function(callback) {var currTime = new Date().getTime(); var timeToCall = Math.max(0, 16 - (currTime - lastTime)); var id = global.setTimeout(function() {callback(currTime + timeToCall);}, timeToCall); lastTime = currTime + timeToCall; return id;}; global.cancelAnimationFrame = function(id) {clearTimeout(id);};})(); if (typeof define === 'function') {define(function() {return global.requestAnimationFrame;});}})(window);


        $(".balls").livequery(function() {

            var canvas1 = document.createElement('canvas'),
                $this = $(this) ,
                _width = $this.data("width") || 250,
                _height = $this.data("height") || 250 ,
                strokeColor = $this.data("strokeColor") || "#0094da",
                fillColor = $this.data("fillColor") || "#0094da";

            $this.append($(canvas1));

            canvas1.width = _width;
            canvas1.height = _height;


            var blob1 = new Blob(canvas1);

            blob1.init(2,
                {
                    radius: {in: .65, out: .7},
                    oscillation: {min: RAD, max: 3 * RAD},
                    stroke: true,
                    strokeColor: strokeColor,
                    strokeBlendMode: "source-over",
                    lineWidth: 1,
                    pointCount: 3,
                    speed: 0.005,
                    interactive: true,
                    viscosity: .6,
                    elasticity: .5,
                    damping: .8,
                    stiffness: .2
                });

            var blob2 = new Blob(canvas1);
            blob2.init(1,
                {
                    interactive: true,
                    pointCount: 3,
                    stroke: false,
                    fill: true,
                    fillColor: fillColor,
                    fillBlendMode: "source-over",
                    lineWidth: 1,
                    radius: {in: .5, out: .6},
                    radiusIn: 200,
                    radiusOut: 250,
                    speed: 0,
                    oscillation: {min: 0, max: RAD},
                    viscosity: .75,
                    elasticity: .1,
                    damping: .5,
                    stiffness: .5

                });

            var mouse = new Point();
            var mouseDest = new Point();

            $(canvas1).on( "mousemove touchmove" , function(e){

                if (!e) e = window.event;

                if (e.pageX || e.pageY) 	{
                    mouseDest.x = e.pageX;
                    mouseDest.y = e.pageY;
                }
                else if (e.clientX || e.clientY) 	{
                    mouseDest.x = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
                    mouseDest.y = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
                }

                var r = $this.find('canvas').offset();
                mouseDest.x -= r.left ;
                mouseDest.y -= r.top;

            });

            $(canvas1).on( "mouseleave touchend" , function(e){

                var r = e.target.getBoundingClientRect();
                mouseDest.x = r.width * .5;
                mouseDest.y = r.height * .5;

            });

            var _update = function() {

                requestAnimationFrame( _update );

                mouse.x += ( mouseDest.x - mouse.x ) * .1;
                mouse.y += ( mouseDest.y - mouse.y ) * .1;

                blob2.update(mouse.x, mouse.y);
                blob1.update(mouse.x, mouse.y, false);

            };

            _update();

        });

    };


    $(document).ready(function() {

        (function() {
            if (!window.console) {
                window.console = {};
            }
            var m = [
                "log", "info", "warn", "error", "debug", "trace", "dir", "group",
                "groupCollapsed", "groupEnd", "time", "timeEnd", "profile", "profileEnd",
                "dirxml", "assert", "count", "markTimeline", "timeStamp", "clear"
            ];
            // define undefined methods as noops to prevent errors
            for (var i = 0; i < m.length; i++) {
                if (!window.console[m[i]]) {
                    window.console[m[i]] = function() {};
                }
            }
        })();

        //$(".mymail-submit-wrapper").append('<div data-fill-color="#727272" class="balls" data-width="170" data-height="170"></div>');

        initBalls();
    });

}( jQuery ));





