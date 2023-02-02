import ReactDOM from "react-dom/client";

const AddRoom = () => {
    return (
        <>
            <div className="row">
                <div className="col-lg-8 offset-lg-2">
                    <h4 className="page-title">Add Room</h4>
                    <a href="/" className="page-title">All Rooms</a>
                </div>
            </div>
            <div className="row">
                <div className="col-lg-8 offset-lg-2">
                    <form>
                        <div className="row">
                            <div className="col-md-6">
                                <div className="form-group">
                                    <label>Room Number</label>
                                    <input className="form-control" type="text"/>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="form-group">
                                    <label>Room type</label>
                                    <select className="select">
                                        <option>Select</option>
                                        <option>Single</option>
                                        <option>Double</option>
                                        <option>Quad</option>
                                        <option>King</option>
                                        <option>Suite</option>

                                        <option>Villa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-md-6">
                                <div className="form-group">
                                    <label>AC/Non AC</label>
                                    <select className="select">
                                        <option>Select</option>
                                        <option>AC</option>
                                        <option>Non Ac</option>
                                    </select>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="form-group">
                                    <label>Food</label>
                                    <select className="select">
                                        <option>Select</option>
                                        <option>Free Breakfast</option>
                                        <option>Free Lunch</option>
                                        <option>Free Dinner</option>
                                        <option>Free Breakfast & Dinner</option>
                                        <option>Free Welcome Drink</option>
                                        <option>No Free Food</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-md-6">
                                <div className="form-group">
                                    <label>Bed Count</label>
                                    <select className="select">
                                        <option>Select</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                    </select>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="form-group">
                                    <label>Charges for Cancellation</label>
                                    <select className="select">
                                        <option>Select</option>
                                        <option>Free</option>
                                        <option>5% Before 24 Hours</option>
                                        <option>No Cancellation Allow</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-md-6">
                                <div className="form-group">
                                    <label>Rent</label>
                                    <input className="form-control" type="text"/>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="form-group">
                                    <label>Mobile Number</label>
                                    <input className="form-control" type="text"/>
                                </div>
                            </div>
                        </div>
                        <div className="custom-file mb-3">
                            <input type="file" className="custom-file-input" name="filename"/>
                            <label className="custom-file-label">Choose file (Photo)</label>
                        </div>
                        <div className="form-group">
                            <label>Message</label>
                            <textarea cols="30" rows="4" className="form-control"></textarea>
                        </div>
                        <div className="m-t-20 text-center">
                            <button className="btn btn-primary submit-btn">Save</button>
                            <button className="btn btn-danger submit-btn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </>
    )
}
export default AddRoom

ReactDOM.createRoot(document.getElementById('add-room')).render(
    <AddRoom/>
)
