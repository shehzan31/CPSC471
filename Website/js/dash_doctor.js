'use strict';

const e = React.createElement;


class Super extends React.Component {
    
    constructor(props) {
        super(props);
            this.state = {
                h_num: null,
                person: [],
                isSet: false
            }
            this.personCardElement = React.createRef();
            this.appointmentsButton = React.createRef();
            this.conditionsButton = React.createRef();
            this.testsButton = React.createRef();
            this.prescriptionsButton = React.createRef();
            this.viewDeck = React.createRef();
    }

    handleSearchChange = (id, data) => {
        this.setState({
            h_num: id,
            person: data,
            isSet: true
        })
        console.log(this.state.person);
        this.personCardElement.current.handlePersonChange(id, data);
        this.appointmentsButton.current.changeUrl('Appointments','');
        this.conditionsButton.current.changeUrl('Conditions','');
        this.prescriptionsButton.current.changeUrl('Prescriptions','');
        this.testsButton.current.changeUrl('Tests','');
    }

    getState() {
        return this.viewDeck.state.source;
    }

    handleClicks = data => {
        if (data == 'Appointments') {
            this.handleAppointments();
        } else if(data == 'Prescriptions'){
            this.handlePrescriptions();
        }else if (data == 'Conditions') {
            this.handleConditions();
        }
    }

    handleAppointments() {
        console.log('Button Clicked');
        this.viewDeck.current.changeInfo('appointments', '../Database/api/object_methods/Doctor/medical_record_doctor/showAllAppointments.php', this.state.h_num);
    }

    handlePrescriptions() {
        console.log('Button Clicked');
        this.viewDeck.current.changeInfo('prescriptions', '../Database/api/object_methods/Doctor/medical_record_doctor/showAllPrescriptions.php', this.state.h_num);
    }

    handleConditions() {
        console.log('Button Clicked');
        this.viewDeck.current.changeInfo('conditions', '../Database/api/object_methods/Doctor/medical_record_doctor/showAllConditions.php', this.state.h_num);
    }
    
    render () {
        if (this.state.isSet == false) {
            return (
                e("div", {className: "doc_page"}, 
                    e(Head, null), 
                    e(Search, {onSearchChange: this.handleSearchChange}),
                    e(PersonCard, {ref: this.personCardElement, style: 'display: none'}),
                    e(DoctorButton, {className:'appointments',  ref: this.appointmentsButton,   style: 'display: none'}),
                    e(DoctorButton, {className:'conditions',    ref: this.conditionsButton,     style: 'display: none'}),
                    e(DoctorButton, {className:'prescriptions', ref: this.prescriptionsButton,  style: 'display: none'}),
                    e(DoctorButton, {className:'test',          ref: this.testsButton,          style: 'display: none'}),
                    e(View,         {className:'view_deck',     ref: this.viewDeck,             style: 'display: none', returnState: this.getState})
                ))
        }
        else {
            console.log('main component changed');
            return (
                e("div", {className: "doc_page"}, 
                    e(Head, null), 
                    e(Search,       {onSearchChange: this.handleSearchChange}),
                    e(PersonCard,   {ref: this.personCardElement}),
                    e(DoctorButton, {ref: this.appointmentsButton,  buttonPushed: this.handleClicks}),
                    e(DoctorButton, {ref: this.conditionsButton, buttonPushed: this.handleClicks}),
                    e(DoctorButton, {ref: this.prescriptionsButton, buttonPushed: this.handleClicks}),
                    e(DoctorButton, {ref: this.testsButton}),
                    e(View,         {ref: this.viewDeck}))
            )
        }
    }
}

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
          className: "doctor_text"
        }, "", this.state.name), e("div", {
          className: "profile_image"
        }));
    }

}

class Search extends React.Component {

    constructor(props) {
        super(props);
            this.state = {
                h_num: null,
                date_sent: null,
                person_Arr: []
            }
        this.onSubmit = this.onSubmit.bind(this);
    }

    onSubmit(event) {
        event.preventDefault();
        console.log(this.state.h_num);
        const url = '../Database/api/object_methods/doctor/getPatientInfo.php'
        const request = new Request(url, {
            method: 'POST',
            body: JSON.stringify(this.state),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        fetch(request)
            .then(res => res.json())
                .then(res => this.notifySuperChange(this.state.h_num, res))
    }

    notifySuperChange = (id, data) => {
        this.props.onSearchChange(id, data);
    }

    render() {
        return (
            e("div", {className: "search_container"}, 
                e("div", {className: "search_bar"}, 
                    e("input", {className:"search_bar_text", placeholder: "patient's health number", onChange: e => this.setState({h_num: e.target.value}) })), 
                e("div", {className: "search_btn", }, 
                    e("input", {className: "search_btn_text", type: "submit", value: "search", onClick: e => this.onSubmit(e)})))
        )
    }
}

class PersonCard extends React.Component {
    constructor(props) {
        super(props);
            this.state = {
                isSet: false,
                hnum: null,
                name: null,
                dob: null
            }
    }

    handlePersonChange = (id, data) => {
        this.setState({
            isSet: true,
            hnum: id,
            name: data.name,
            dob: data.dob
        }) 
        console.log('received info in child');
    }

    render() {
        if (this.state.isSet == false) {
            console.log('PersonCard mounted');
            return (null)
        } else {
            console.log('PersonCard mounted with info');
            return (
                e("div", {className: "person_card"}, 
                    e("h1", {className: "person_name"}, this.state.name), 
                    e("h2", {className: "person_hnum"}, this.state.hnum), 
                    e("h3", {className: "person_dob"}, this.state.dob), 
                    e("div", {className: "person_image"}))
            )
        }
    }
}

class DoctorButton extends React.Component {

    constructor(props) {
        super(props);
            this.state = {
                url: '',
                name: ''
            }
    }

    changeUrl = (name, url) => {
        this.setState( {
            name: name,
            url: url
        }) 
    }

    notifySuperOfClick() {
        this.props.buttonPushed(this.state.name);
    }

    render() {
        if (this.state.name == '') {
            return (null)
        } else {
            return (e("button", {className: this.state.name, onClick: e => this.notifySuperOfClick()}, this.state.name))
        }     
    }
}


class View extends React.Component {
    constructor(props) {
        super(props);
            this.state = {
                source: '',
                url: '',
                data: [],
                hnum: ''
            }
    }

    changeInfo = (calle, passed_url, h_num) => {

        const request = new Request(passed_url, {
            method: 'POST',
            body: JSON.stringify(h_num),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        
        fetch(request)
            .then(res => res.json())
            .then(res => {
                this.setState( {
                    source: calle,
                    url:    passed_url,
                    data:   res.records,
                    hnum: h_num
                })
            })
    }

    getState = () => {
        return (this.state.source)
    }

    getPatient = () => {
        return (this.state.hnum)
    }




    render() {
        if (this.state.source == '') {
            return (null)
        } else {
            if (this.state.source == 'appointments') {
                return (
                    e("div", {className:'view_deck'}, e("h1", { className: "appoint_text" }, "Appointments"),
                    e("table", {className: "appoint_info"},
                        e("tr", null, " ", 
                            e("th", null, "ID"), " ", 
                            e("th", null, "Location"), " ", 
                            e("th", null, "Date"), 
                            e("th", null, "Time")), 
                            this.state.data.map(records => 
                                e("tr", { className: "trow" },
                                e("td", null, " ", records.Appointment, " "), 
                                e("td", null, " ", records.Location, " "), 
                                e("td", null, " ", records.Date, " "), 
                                e("td", null, " ", records.Time, " ")))),
                    e(Submit, {className: "submit_form", returnState:this.getState, getHNum:this.getPatient})
                ))
            }
            else if(this.state.source == 'prescriptions'){
                return (
                    e("div", {className:'view_deck'}, e("h1", { className: "pres_text" }, "Prescriptions"),
                    e("table", {className: "pres_info"},
                        e("tr", null, " ", 
                            e("th", null, "Name"), " ", 
                            e("th", null, "Type"), " ", 
                            e("th", null, "Field")), 
                            this.state.data.map(records => 
                                e("tr", { className: "trow" },
                                e("td", null, " ", records.Prescription, " "), 
                                e("td", null, " ", records.Type, " "), 
                                e("td", null, " ", records.Field, " ")))),
                    e(Submit, {className: "submit_form", returnState:this.getState, getHNum:this.getPatient})
                ))
            } else if (this.state.source == 'conditions') {
                return (
                    e("div", {className:'view_deck'}, e("h1", { className: "cond_text" }, "Conditions"),
                    e("table", {className: "cond_info"},
                        e("tr", null, " ", 
                            e("th", null, "Condition"), " ", 
                            e("th", null, "Date"), 
                            e("th", null, "Chart")), 
                            this.state.data.map(records => 
                                e("tr", { className: "trow" },
                                e("td", null, " ", records.Condition, " "), 
                                e("td", null, " ", records.Date, " "), 
                                e("td", null, " ", records.Chart, " ")))),
                    e(Submit, {className: "submit_form", returnState:this.getState, getHNum:this.getPatient})
                ))
            }
        }
    }
}

class Submit extends React.Component {
    constructor(props) {
        super(props);
            this.state = {
                hnum: null,
                data1: null,
                data2: null,
                data3: null,
                data4: null,
                data5: null
            }
    }

    onSubmit = (event) => {
        const str = this.props.getHNum();
        this.setState({
            hnum: str
        }, () => {
            this.sendData();
        });
        return;
    }

    sendData = () => {
        console.log(this.state);
            if (this.props.returnState() == 'appointments') {
            
                const request = new Request('../Database/api/object_methods/doctor/edits/editsAppointment.php', {
                    method: 'POST',
                    body: JSON.stringify(this.state),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })

                fetch(request)
                .then(res => res.json())
                .then(res => {
                    console.log('appointment added');
                })
    
            }
            else if(this.props.returnState() == 'prescriptions'){
                const request = new Request('../Database/api/object_methods/doctor/edits/editsPrescription.php', {
                    method: 'POST',
                    body: JSON.stringify(this.state),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })

                fetch(request)
                .then(res => res.json())
                .then(res => {
                    console.log('prescription added');
                })
            }else if (this.props.returnState() == 'conditions') {
            
                const request = new Request('../Database/api/object_methods/doctor/edits/editsCondition.php', {
                    method: 'POST',
                    body: JSON.stringify(this.state),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })

                fetch(request)
                .then(res => res.json())
                .then(res => {
                    console.log('condition added');
                })
    
            }
    }

    render() {
        if (this.props.returnState() == '') {
            return (null)
        } else {
            if (this.props.returnState() == 'appointments') {
                return (
                    e("div", {className: "submit_form"}, 
                        e("h3", {className:"submit_form_text"}, "Enter new appointment"), 
                        e("div", {className: "location"}, 
                            "Location", e("input", {className: "location_text", placeholder: "123rd St SE, Townsville BC A1A 1A1", onChange: e => this.setState({data1: e.target.value}) })), 
                        e("div", {className: "date"}, 
                            "Date", e("input", {className: "date_text", placeholder: "1900-01-01", onChange: e => this.setState({data2: e.target.value}) })), 
                        e("div", {className: "time"}, 
                            "Time", e("input", {className: "time_text",placeholder: "12:00", onChange: e => this.setState({data3: e.target.value}) })), 
                        e("div", {className: "submit_btn"}, 
                            e("input", {className: "submit_btn_text",type: "submit", value: "Submit", onClick: e => this.onSubmit(e)}))
                    )
                )
            } 
            else if(this.props.returnState() == 'prescriptions'){
                return (
                    e("div", {className: "submit_form"}, 
                        e("h3", {className:"submit_form_text"}, "Enter new prescription"), 
                        e("div", {className: "pname"}, 
                            "Name", e("input", {className: "pname_text", placeholder: "Colon Medicine", onChange: e => this.setState({data1: e.target.value}) })), 
                        e("div", {className: "type"}, 
                            "Type", e("input", {className: "type_text", placeholder: "Tablets", onChange: e => this.setState({data2: e.target.value}) })), 
                        e("div", {className: "field"}, 
                            "Field", e("input", {className: "field_text",placeholder: "Painkiller", onChange: e => this.setState({data3: e.target.value}) })),
                        e("div", {className: "startD"}, 
                            "Start Date", e("input", {className: "startD_text",placeholder: "01-01-2000", onChange: e => this.setState({data4: e.target.value}) })),
                        e("div", {className: "endD"}, 
                            "End Date", e("input", {className: "endD_text",placeholder: "01-01-2000", onChange: e => this.setState({data5: e.target.value}) })), 
                        e("div", {className: "submit_btn"}, 
                            e("input", {className: "submit_btn_text",type: "submit", value: "Submit", onClick: e => this.onSubmit(e)}))
                    )
                )
            }
			 else if (this.props.returnState() == 'conditions') {
                return (
                    e("div", {className: "submit_form"}, 
                        e("h3", {className:"submit_form_text"}, "Enter new condition"), 
                        e("div", {className: "condition"}, 
                            "Condition", e("input", {className: "condition_text", placeholder: "normal", onChange: e => this.setState({data1: e.target.value}) })), 
                        e("div", {className: "date"}, 
                            "Date", e("input", {className: "date_text", placeholder: "2021-04-12", onChange: e => this.setState({data2: e.target.value}) })), 
                        e("div", {className: "chart"}, 
                            "Chart", e("input", {className: "chart_text",placeholder: "no comment", onChange: e => this.setState({data3: e.target.value}) })), 
                        e("div", {className: "submit_btn"}, 
                            e("input", {className: "submit_btn_text",type: "submit", value: "Submit", onClick: e => this.onSubmit(e)}))
                    )
                )
            }
            else {
                return (e('div', null))
            }
        }
    }
}

// Render everything

const domContainer2 = document.querySelector('#doctor_page');
ReactDOM.render(e(Super), domContainer2);