'use strict';

//const { get } = require("core-js/core/dict");

const e = React.createElement;

class Dash extends React.Component {

    constructor(props) {
        super(props);
        this.state = {  list: [],
                        list2: [] }
    }

    componentDidMount = () => {
        fetch('../Database/api/object_methods/finds/hnumber.php')
            .then(res => res.json())
                .then(data => {
                    fetch ('../Database/api/object_methods/dependent/returnAllDependents.php')
                        .then(res1 => res1.json())
                            .then(data1 => {
                                this.setState({ list: data.records,
                                                list2: data1.records });
                                console.log(data1.records);
                                console.log(data.records);
                        });
                });
    }

    render() {
        if ((this.state.list != []) && (this.state.list2 != []) && (this.state.list != null) && (this.state.list2 != null)) {
            return (
                e("div", null, e("h1", { className: "dashboard_text" }, "Dashboard"),
                    e("table", { className: "dash_info" }, "Health Diagnosis",
                        e("thead", null, e("tr", null, " ", e("th", null, "Doctor ID"), " ",  " ", e("th", null, "Condition"), e("th", null, "Date"), " ")),
                        e("tbody", null, this.state.list.map(records => e("tr", { className: "trow" },
                            e("td", null, " ", records.doctor_ID, " "), e("td", null, " ", records.condition, " "), e("td", null, " ", records.date, " "), " ")))),
                    e("table", {className: "dep_info"}, "Dependents",
                        e("thead", null, e("tr", null, " ", e("th", null, "First Name"), " ", " ", e("th", null, "Middle Initial"), e("th", null, "Last name"), e("th", null, "Relation"))),
                            e("tbody", null, this.state.list2.map(records => e("tr", { className: "trow" },
                            e("td", null, " ", records.DFName, " "), e("td", null, " ", records.DMInit, " "), e("td", null, " ", records.DLName, " "), e("td", null, " ", records.Relation, " "))   
                        ))
                    )
                )
            );
        } else {
            if (this.state.list != [] && (this.state.list != null)) {
                return (
                    e("div", null, e("h1", { className: "dashboard_text" }, "Dashboard"),
                        e("table", { className: "dash_info" }, "Health Diagnosis",
                            e("thead", null , e("tr", null, " ", e("th", null, "Doctor ID"), " ",  " ", e("th", null, "Condition"), e("th", null, "Date"), " ")),
                            e ("tbody", null, this.state.list.map(records => e("tr", { className: "trow"},
                                e("td", null, " ", records.doctor_ID, " "), e("td", null, " ", records.condition, " "), e("td", null, " ", records.date, " "), " "))),
                    ))
                );
            }
            if (this.state.list2 != [] && (this.state.list2 != null)) {
                return (
                    e("div", null, e("h1", { className: "dashboard_text" }, "Dashboard"),
                        e("table", {className: "dep_info"}, "Dependents",
                            e("thead", null, e("tr", null, " ", e("th", null, "First Name"), " ", " ", e("th", null, "Middle Initial"), e("th", null, "Last name"), e("th", null, "Relation"))),
                            e("tbody", null, this.state.list2.map(records => e("tr", { className: "trow" },
                                e("td", null, " ", records.DFName, " "), e("td", null, " ", records.DMInit, " "), e("td", null, " ", records.DLName, " "), e("td", null, " ", records.Relation, " "))   
                            ))
                        )
                    )
                );
            }
            return e("div", null, e("h1", { className: "dashboard_text" }, " Dashboard "),
                e("SampleDash", { className: "dash_info_pane" }));
        }
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
                    e("thead", null, e("tr", null, " ", e("th", null, "ID"), " ", e("th", null, "Location"), " ", e("th", null, "Date"), e("th", null, "Time"))),
                        e("tbody", {className:"abody"}, this.state.list.map(records => e("tr", { className: "trow" },
                            e("td", null, " ", records.Appointment, " "), e("td", null, " ", records.Location, " "), e("td", null, " ", records.Date, " "), e("td", null, " ", records.Time, " "))), " ")))
            );
        } else {
            return e("div", null, e("h1", { className: "appoint_text" }, "Appointments"),
                e("h2", { className: "appoint_info_text" }, "You have no appointments"));
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
                        e("thead", null, e("tr", null, " ", e("th", null, "Test Name"), " ", e("th", null, "Result"), " ", e("th", null, "Date"))),
                            e("tbody", {className:"tbody"}, this.state.list.map(records => e("tr", { className: "trow" },
                            e("td", null, " ", records.Test_Name, " "), e("td", null, " ", records.Result, " "), e("td", null, " ", records.Date, " "))), " ")))
            );
        } else {
            return e("div", null, e("h1", { className: "test_text" }, "Test"),
                e("h2", { className: "test_info_test" }, "You have no tests"));
        }
    }
}

const domContainer3 = document.querySelector('#tests');
ReactDOM.render(e(Test), domContainer3);

class Pres extends React.Component {

    constructor(props){
        super(props);
            this.state = {list:[]}
    }

    componentDidMount() {
        fetch('../Database/api/object_methods/medical_record/showAllPrescriptions.php')
            .then(res => res.json())
            .then(data => {
                this.setState({ list: data.records})
                console.log(data.records);
            });
    }

    render() {
        if ((this.state.list != []) && (this.state.list != null)) {
            return(
                e("div", null, e("h1", {className: "pres_text"}, "Prescriptions"),
                    e("table", {className: "pres_info"},
                        e("thead", null, e("tr", null, " ", e("th", null, "Name"), " ", e("th", null, "Type"), " ", e("th", null, "Field"))),
                            e("tbody", {className:"pbody"}, this.state.list.map(records => e("tr", {className: "trow"},
                                e("td", null, " ", records.Prescription, " "), e("td", null, " ", records.Type, " "), e("td", null, " ", records.Field, " "))), " ")))
            );
        } else {
            return e("div", null, e("h1", { className: "pres_text"}, "Prescriptions"),
            e("h2", {className: "pres_info_text"}, "You have no prescriptions"));
        }
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
