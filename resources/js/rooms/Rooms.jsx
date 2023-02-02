import {Link} from "react-router-dom";
import ReactDOM from "react-dom/client";

const Rooms = () => {
  return (
      <>
          <div className="row">
              <div className="col-sm-4 col-4">
                  <h4 className="page-title">All Rooms</h4>
              </div>
              <div className="col-sm-8 col-8 text-right m-b-20">
                  <a href="/rooms/create" className="btn btn btn-primary btn-rounded float-right"><i className="fas fa-plus"></i> Add Room</a>
              </div>
          </div>
          <div className="row">
              <div className="col-md-12">
                  <div className="table-responsive">
                      <table className="table table-striped custom-table">
                          <thead>
                          <tr>
                              <th style={{width:'10%'}}>Room number</th>
                              <th style={{width:'10%'}}>Img</th>
                              <th>Room type</th>
                              <th>AC/Non-AC</th>
                              <th style={{width:'10%'}}>Food</th>
                              <th>Bed Count</th>
                              <th style={{width:'10%'}}>Phone</th>
                              <th style={{width:'10%'}}>Rent</th>
                              <th className="text-right">Action</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td>201</td>
                              <td><img width="28" height="28" src="/assets/img/user.jpg" className="rounded-circle m-r-5" alt=""/></td>
                              <td>Single</td>
                              <td>AC</td>
                              <td>Free Breakfast & Dinner</td>
                              <td>1</td>
                              <td>987654321</td>
                              <td>$ 25</td>
                              <td className="text-right">
                                  <div className="dropdown dropdown-action">
                                      <a href="#" className="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                                          className="fas fa-ellipsis-v"></i></a>
                                      <div className="dropdown-menu dropdown-menu-right">
                                          <a className="dropdown-item" href="edit-room.html"><i className="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                          <a className="dropdown-item" href="#" data-toggle="modal" data-target="#delete_room"><i
                                              className="fas fa-trash-alt m-r-5"></i> Delete</a>
                                      </div>
                                  </div>
                              </td>
                          </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>

      </>
  )
}

export default Rooms

ReactDOM.createRoot(document.getElementById('room-component')).render(
    <Rooms/>
)




