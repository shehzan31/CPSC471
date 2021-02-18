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
        return e("div", null, e("h1", { className: "appoint_text"}, " Appointments "), 
        e("SampleDash", {className: "appoint_info_pane"}));
      }
}

const domContainer1 = document.querySelector('#appointments');
ReactDOM.render(e(Appoint), domContainer1);


class Test extends React.Component {
    render() {
        return e("div", null, e("h1", { className: "tests_text"}, " Tests "), 
        e("SampleDash", {className: "tests_info_pane"}));
      }
}

const domContainer3 = document.querySelector('#tests');
ReactDOM.render(e(Test), domContainer3);

class Pres extends React.Component {
    render() {
        return e("div", null, e("h1", { className: "pres_text"}, " Prescriptions "), 
        e("SampleDash", {className: "pres_info_pane"}));
      }
}

const domContainer4 = document.querySelector('#prescriptions');
ReactDOM.render(e(Pres), domContainer4);

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