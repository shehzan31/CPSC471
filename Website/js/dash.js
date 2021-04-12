'use strict';

//const { get } = require("core-js/core/dict");

const e = React.createElement;

class Dash extends React.Component {
    render() {
        return e("div", null, e("h1", { className: "dashboard_text" }, " Dashboard "),
            e("SampleDash", { className: "dash_info_pane" }));
    }

}

function SampleDash() {
    return e("div", null);
}

const domContainer = document.querySelector('#dashboard');
ReactDOM.render(e(Dash), domContainer);



class Appoint extends React.Component {

    constructor(props) {
        super(props);
        this.state = { list: [] }
    }


    componentDidMount() {
        fetch('../Database/api/object_methods/medical_record/showAllAppointments.php')
            .then(res => res.json())
            .then(data => {
                this.setState({ list: data.records })
                console.log(data.records);
            });
    }

    render() {
        if ((this.state.list != []) && (this.state.list != null)) {
            return (
                e("div", null, e("h1", { className: "appoint_text" }, "Appointments"),
                    e("table", { className: "appoint_info" },
                        e("tr", null, " ", e("th", null, "ID"), " ", e("th", null, "Location"), " ", e("th", null, "Date"), e("th", null, "Time")),
                        this.state.list.map(records => e("tr", { className: "trow" },
                            e("td", null, " ", records.Appointment, " "), e("td", null, " ", records.Location, " "), e("td", null, " ", records.Date, " "), e("td", null, " ", records.Time, " "))), " "))
            );
        } else {
            return e("div", null, e("h1", { className: "appoint_text" }, "Appointments"),
                e("SampleDash", { className: "appoint_info_pane" }));
        }
    }
}

const domContainer1 = document.querySelector('#appointments');
ReactDOM.render(e(Appoint), domContainer1);


class Test extends React.Component {

    constructor(props) {
        super(props);
        this.state = { list: [] }
    }


    componentDidMount() {
        fetch('../Database/api/object_methods/medical_record/showAllTests.php')
            .then(res => res.json())
            .then(data => {
                this.setState({ list: data.records })
                console.log(data.records);
            });
    }

    render() {
        if ((this.state.list != []) && (this.state.list != null)) {
            return (
                e("div", null, e("h1", { className: "test_text" }, "Tests"),
                    e("table", { className: "test_info" },
                        e("tr", null, " ", e("th", null, "Test Name"), " ", e("th", null, "Result"), " ", e("th", null, "Date")),
                        this.state.list.map(records => e("tr", { className: "trow" },
                            e("td", null, " ", records.Test_Name, " "), e("td", null, " ", records.Result, " "), e("td", null, " ", records.Date, " "))), " "))
            );
        } else {
            return e("div", null, e("h1", { className: "test_text" }, "Test"),
                e("SampleDash", { className: "test_info_pane" }));
        }
    }
}

const domContainer3 = document.querySelector('#tests');
ReactDOM.render(e(Test), domContainer3);

class Pres extends React.Component {
    render() {
        return e("div", null, e("h1", { className: "pres_text" }, " Prescriptions "),
            e("SampleDash", { className: "pres_info_pane" }));
    }
}

const domContainer4 = document.querySelector('#prescriptions');
ReactDOM.render(e(Pres), domContainer4);


class Head extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            name: 'default',
            isLoaded: false
        }
    }

    componentDidMount() {
        fetch('../Database/api/object_methods/person/getName.php')
            .then(res => res.json())
            .then(data => {
                this.setState({
                    name: data,
                    isLoaded: true
                })
                console.log(data);
            });
    }

    render() {
        return e("div", null, e("h1", {
            className: "header_text"
        }, "", this.state.name), e("div", {
            className: "profile_image"
        }));
    }

}

const domContainer2 = document.querySelector('#header');
ReactDOM.render(e(Head), domContainer2);