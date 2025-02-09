<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!--<link rel="stylesheet"
        href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5"
        rel="stylesheet">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
    <link href="{{ asset('CSS/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/search.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/notification.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/graph.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/card.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/clock.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('CSS/clock2.css') }}" rel="stylesheet">
   <!-- <link href="{{ asset('CSS/object-structure1.css') }}" rel="stylesheet">-->
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')
    @include('admin.scripts')
    <style>
@function remy($value) {
  @return ($value / 16px) * 1rem;
}
/*body {
  margin-top: 2rem;
  font: 100% "Open sans", "Trebuchet MS", sans-serif;
}*/
* {
  padding: 0;

  user-select: none;

  margin: 0;
}
a {
  text-decoration: none;
}
ol,
ul {
  list-style: none;
}
/**
 * Hidden fallback
 */
[hidden] {
  display: none;
  visibility: hidden;
}
/**
 * Styling navigation
 */
header {
  margin-right: auto;
  margin-left: auto;
  max-width: remy(360px);
  box-shadow: 0 3px 12px rgba(0, 0, 0, 0.25);
}
/**
 * Styling top level items
 */
.nav a,
.nav label {
  display: block;
  padding: 0.85rem;
  color: #fff;
  background-color: #151515;
  box-shadow: inset 0 -1px lighten(#151515, 3%);
  transition: all 0.25s ease-in;
  &:focus,
  &:hover {
    color: rgba(255, 255, 255, 0.5);
    background: darken(#151515, 7%);
  }
}
.nav label {
  cursor: pointer;
}
/**
 * Styling first level lists items
 */
.group-list a,
.group-list label {
  padding-left: 2rem;
  background: #252525;
  box-shadow: inset 0 -1px lighten(#252525, 7%);
  &:focus,
  &:hover {
    background: darken(#252525, 7%);
  }
}
/**
 * Styling second level list items
 */
.sub-group-list a,
.sub-group-list label {
  padding-left: 4rem;
  background: #353535;
  box-shadow: inset 0 -1px lighten(#353535, 7%);
  &:focus,
  &:hover {
    background: darken(#353535, 7%);
  }
}
/**
 * Styling third level list items
 */
.sub-sub-group-list a,
.sub-sub-group-list label {
  padding-left: 6rem;
  background: #454545;
  box-shadow: inset 0 -1px lighten(#454545, 7%);
  &:focus,
  &:hover {
    background: darken(#454545, 7%);
  }
}
/**
 * Hide nested lists
 */
.group-list,
.sub-group-list,
.sub-sub-group-list {
  height: 100%;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.5s ease-in-out;
}

.nav__list input[type="checkbox"]:checked + label + ul {
  /* reset the height when checkbox is checked */
  max-height: 1000px;
}
/**
 * Rotating chevron icon
 */
label > span {
  float: right;
  transition: transform 0.65s ease;
}
.nav__list input[type="checkbox"]:checked + label > span {
  transform: rotate(90deg);
}
/**
 * Styling footer
 */
footer {
  padding-top: 1rem;
  padding-bottom: 1rem;
  background-color: #050505;
}
.soc-media {
  display: flex;
  justify-content: center;
}
.soc-media li:nth-child(n + 2) {
  margin-left: 1rem;
}
.soc-media a {
  font-size: 1.25rem;
  color: rgba(255, 255, 255, 0.65);
  transition: color 0.25s ease-in;
  &:focus,
  &:hover {
    color: rgba(255, 255, 255, 0.2);
  }
}

    </style>
    <div class="row"> <div class="col-6">
    <div role="banner">
        <nav class="nav" role="navigation">
          <ul class="nav__list">
            <li>
              <input id="group-1" type="checkbox" hidden />
              <label for="group-1"><span class="fa fa-angle-right"></span>item-1-level</label>
              <ul class="group-list">
                <li><a href="#">item-1-opt</a></li>
                <li>
                  <input id="sub-group-1" type="checkbox" hidden />
                  <label for="sub-group-1"><span class="fa fa-angle-right"></span> item-2-level</label>
                  <ul class="sub-group-list">
                    <li><a href="#">item-1-opt-1</a></li>
                    <li><a href="#">item-1-opt-2</a></li>
                    <li><a href="#">item-1-opt-3</a></li>
                    <li>
                      <input id="sub-sub-group-1" type="checkbox" hidden />
                      <label for="sub-sub-group-1"><span class="fa fa-angle-right"></span> item-1-opt-4-level</label>
                      <ul class="sub-sub-group-list">
                        <li><a href="#">item-1-opt-4-1</a></li>
                        <li><a href="#">item-1-opt-4-2</a></li>
                        <li><a href="#">item-1-opt-4-3</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li>
              <input id="group-2" type="checkbox" hidden />
              <label for="group-2"><span class="fa fa-angle-right"></span>item-2</label>
              <ul class="group-list">
                <li>
                <li><a href="#">item-1</a></li>
                <li><a href="#">item-2</a></li>
                <input id="sub-group-2" type="checkbox" hidden />
                <label for="sub-group-2"><span class="fa fa-angle-right"></span> item-3</label>
                <ul class="sub-group-list">
                  <li><a href="#">item-3-1</a></li>
                  <li><a href="#">item-3-2</a></li>
                  <li>
                    <input id="sub-sub-group-2" type="checkbox" hidden />
                    <label for="sub-sub-group-2"><span class="fa fa-angle-right"></span> item-3-3</label>
                    <ul class="sub-sub-group-list">
                      <li><a href="#">item-3-3-1</a></li>
                    </ul>
                  </li>
                </ul>
            </li>
          </ul>
          </li>
          <li>
            <input id="group-3" type="checkbox" hidden />
            <label for="group-3"><span class="fa fa-angle-right"></span>item-3-level</label>
            <ul class="group-list">
              <li>
              <li><a href="#">item-3</a></li>
              <li><a href="#">item-3-1</a></li>
              <input id="sub-group-3" type="checkbox" hidden />
              <label for="sub-group-3"><span class="fa fa-angle-right"></span> Second level</label>
              <ul class="sub-group-list">
                <li><a href="#">2nd level nav item</a></li>
                <li><a href="#">2nd level nav item</a></li>
                <li><a href="#">2nd level nav item</a></li>
                <li>
                  <input id="sub-sub-group-3" type="checkbox" hidden />
                  <label for="sub-sub-group-3"><span class="fa fa-angle-right"></span> Third level</label>
                  <ul class="sub-sub-group-list">
                    <li><a href="#">3rd level nav item</a></li>
                    <li><a href="#">3rd level nav item</a></li>
                    <li><a href="#">3rd level nav item</a></li>
                  </ul>
                </li>
              </ul>
          </li>
          </ul>
          </li>
          <li>
            <input id="group-4" type="checkbox" hidden />
            <label for="group-4"><span class="fa fa-angle-right"></span> item-4-level</label>
            <ul class="group-list">
              <li>
              <li><a href="#">1st level item</a></li>
              <input id="sub-group-4" type="checkbox" hidden />
              <label for="sub-group-4"><span class="fa fa-angle-right"></span> Second level</label>
              <ul class="sub-group-list">
                <li><a href="#">2nd level nav item</a></li>
                <li><a href="#">2nd level nav item</a></li>
              </ul>
          </li>
          </ul>
          </li>
          </ul>-->
        </nav>
    </div>
      </div>
    </div>
</body>
</html>