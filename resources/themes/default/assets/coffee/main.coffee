$ ->
  logoLine = new TimelineLite();

  logoLine.to '.logo', 0,
      {
        marginTop: '-125px'
        top       : '50%',
        scaleX    : 0,
        scaleY    : 0,
      }

  logoLine.to '.logo', 1,
      {
        delay    : 1,
        scaleX    : 1,
        scaleY    : 1,
        ease      : Back.easeOut.config(1.2)

      }

  logoLine.to '.logo', 0.6,
      {
        marginTop: '0'
        top       : '50px',
        clearProps: "all",

      }

  TweenMax.to 'h1', 0.5,
      {
        delay: 2.5
        opacity: 1
      }