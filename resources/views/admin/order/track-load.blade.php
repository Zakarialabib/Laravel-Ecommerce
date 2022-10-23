                                            <tr>
                                                <th>{{ __("Title") }}</th>
                                                <th>{{ __("Details") }}</th>
                                                <th>{{ __("Date") }}</th>
                                                <th>{{ __("Time") }}</th>
                                                <th>{{ __("Action") }}</th>
                                            </tr>
                                            @foreach($order->tracks as $track)

                                            <tr data-id="{{ $track->id }}">
                                                <td width="30%">{{ $track->title }}</td>
                                                <td width="30%">{{ $track->text }}</td>
                                                <td>{{  date('Y-m-d',strtotime($track->created_at)) }}</td>
                                                <td>{{  date('h:i:s:a',strtotime($track->created_at)) }}</td>
                                                <td>
                                                    <div class="action-list">
                                                        <a data-href="{{ route('admin-order-track-update',$track->id) }}" class="track-edit"> <i class="fas fa-edit"></i>{{__('Edit')}}</a>
                                                        <a href="javascript:;" data-href="{{ route('admin-order-track-delete',$track->id) }}" class="track-delete"><i class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach