'use strict';

const e = React.createElement;

class Dash extends React.Component {
    render() {
      return e("div", null, e("h1", { className: "dashboard_text"}, " Dashboard "), 
      e("SampleDash", {className: "dash_info_pane"}));
    }
  
  }
  
function SampleDash() {
    return e("div", null);
  }

const domContainer = document.querySelector('#dashboard');
ReactDOM.render(e(Dash), domContainer);



class Appoint extends React.Component {
    render() {
        return e("h1", null, "Appointments")
    }
}

const domContainer1 = document.querySelector('#appointments');
ReactDOM.render(e(Appoint), domContainer1);

const name_s = "John Doe";

class Head extends React.Component {
    render() {
      return React.createElement("div", null, React.createElement("h1", {
        className: "header_text"
      }, "", name_s), React.createElement("div", {
        className: "profile_image"
      }));
    } 
  }

const domContainer2 = document.querySelector('#header');
ReactDOM.render(e(Head), domContainer2);