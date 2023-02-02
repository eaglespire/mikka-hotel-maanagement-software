<div class="app-modal" id="app-modal">
    <div class="app-modal-header">
        <h6>Header content</h6>
        <span class="close-btn">&times;</span>
    </div>
    <!-- things that scroll -->
    <div class="app-modal-container rounded">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<div class="app-modal-overlay" id="modal-overlay"></div>


@push('styles')
    <style>
        .app-modal{
            /* This way it could be display flex or grid or whatever also. */
            display: block;
            position: fixed;
            top: 50%;
            left: 50%;
            /* Use this for centering if unknown width/height */
            transform: translate(-50% ,-50%);
            width: 600px;
            max-width: 100%;
            height: 450px;
            max-height: 100%;
            z-index: 1010;
            background: #323A4E;
            box-shadow: 0 0 60px 10px rgba(0, 0, 0, 0.9);
            border-radius: 20px;
        }

        .closed {
            display: none;
        }
        .app-modal-container {
            /* cover the modal */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            /* spacing as needed */
            padding: 50px 50px 20px 50px;

            /* let it scroll */
            overflow: auto;
            z-index: 0;
        }
        .app-modal-header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .5rem;
            background-color: #fff;
            color: #000;
            width: 100%;
            padding-left: 20px;
            padding-right: 20px;
            position: fixed;
            z-index: 10;
        }

        .close-btn{
            position: absolute;

            /* don't need to go crazy with z-index here, just sits over .modal-guts */
            z-index: 1;

            top: 10px;

            /* needs to look OK with or without scrollbar */
            right: 20px;
        }
        .app-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 50;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
        }
        .app-modal .close-button {
            font-size: 2.0rem;
            cursor: pointer !important;
            color: #e9ecef;
        }
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
@endpush
